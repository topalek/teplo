<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Traversable;

class Html
{
    public static $attributeRegex = '/(^|.*\])([\w\.\+]+)(\[.*|$)/u';

    public static $voidElements = [
        'area'    => 1,
        'base'    => 1,
        'br'      => 1,
        'col'     => 1,
        'command' => 1,
        'embed'   => 1,
        'hr'      => 1,
        'img'     => 1,
        'input'   => 1,
        'keygen'  => 1,
        'link'    => 1,
        'meta'    => 1,
        'param'   => 1,
        'source'  => 1,
        'track'   => 1,
        'wbr'     => 1,
    ];

    public static $attributeOrder = [
        'type',
        'id',
        'class',
        'name',
        'value',

        'href',
        'src',
        'srcset',
        'form',
        'action',
        'method',

        'selected',
        'checked',
        'readonly',
        'disabled',
        'multiple',

        'size',
        'maxlength',
        'width',
        'height',
        'rows',
        'cols',

        'alt',
        'title',
        'rel',
        'media',
    ];

    public static $dataAttributes = ['aria', 'data', 'data-ng', 'ng'];

    public static $normalizeClassAttribute = false;

    public static function decode($content)
    {
        return htmlspecialchars_decode($content, ENT_QUOTES);
    }

    public static function endTag($name)
    {
        if ($name === null || $name === false) {
            return '';
        }

        return "</$name>";
    }

    public static function style($content, $options = [])
    {
        return static::tag('style', $content, $options);
    }

    public static function tag($name, $content = '', $options = [])
    {
        if ($name === null || $name === false) {
            return $content;
        }
        $html = "<$name" . static::renderTagAttributes($options) . '>';
        return isset(static::$voidElements[strtolower($name)]) ? $html : "$html$content</$name>";
    }

    public static function renderTagAttributes($attributes)
    {
        if (count($attributes) > 1) {
            $sorted = [];
            foreach (static::$attributeOrder as $name) {
                if (isset($attributes[$name])) {
                    $sorted[$name] = $attributes[$name];
                }
            }
            $attributes = array_merge($sorted, $attributes);
        }

        $html = '';
        foreach ($attributes as $name => $value) {
            if (is_bool($value)) {
                if ($value) {
                    $html .= " $name";
                }
            } elseif (is_array($value)) {
                if (in_array($name, static::$dataAttributes)) {
                    foreach ($value as $n => $v) {
                        if (is_array($v)) {
                            $html .= " $name-$n='" . json_encode($v) . "'";
                        } elseif (is_bool($v)) {
                            if ($v) {
                                $html .= " $name-$n";
                            }
                        } elseif ($v !== null) {
                            $html .= " $name-$n=\"" . static::encode($v) . '"';
                        }
                    }
                } elseif ($name === 'class') {
                    if (empty($value)) {
                        continue;
                    }
                    if (static::$normalizeClassAttribute === true && count($value) > 1) {
                        // removes duplicate classes
                        $value = explode(' ', implode(' ', $value));
                        $value = array_unique($value);
                    }
                    $html .= " $name=\"" . static::encode(implode(' ', $value)) . '"';
                } elseif ($name === 'style') {
                    if (empty($value)) {
                        continue;
                    }
                    $html .= " $name=\"" . static::encode(static::cssStyleFromArray($value)) . '"';
                } else {
                    $html .= " $name='" . json_encode($value) . "'";
                }
            } elseif ($value !== null) {
                $html .= " $name=\"" . static::encode($value) . '"';
            }
        }

        return $html;
    }

    public static function encode($content, $doubleEncode = true)
    {
        return htmlspecialchars(
            (string)$content,
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8',
            $doubleEncode
        );
    }

    public static function cssStyleFromArray(array $style)
    {
        $result = '';
        foreach ($style as $name => $value) {
            $result .= "$name: $value; ";
        }
        // return null if empty to avoid rendering the "style" attribute
        return $result === '' ? null : rtrim($result);
    }

    public static function script($content, $options = [])
    {
        return static::tag('script', $content, $options);
    }

    public static function cssFile($url, $options = [])
    {
        if (!isset($options['rel'])) {
            $options['rel'] = 'stylesheet';
        }
        $options['href'] = url($url);

        if (isset($options['condition'])) {
            $condition = $options['condition'];
            unset($options['condition']);
            return self::wrapIntoCondition(static::tag('link', '', $options), $condition);
        } elseif (isset($options['noscript']) && $options['noscript'] === true) {
            unset($options['noscript']);
            return '<noscript>' . static::tag('link', '', $options) . '</noscript>';
        }

        return static::tag('link', '', $options);
    }

    private static function wrapIntoCondition($content, $condition)
    {
        if (strpos($condition, '!IE') !== false) {
            return "<!--[if $condition]><!-->\n" . $content . "\n<!--<![endif]-->";
        }

        return "<!--[if $condition]>\n" . $content . "\n<![endif]-->";
    }

    public static function jsFile($url, $options = [])
    {
        $options['src'] = url($url);
        if (isset($options['condition'])) {
            $condition = $options['condition'];
            unset($options['condition']);
            return self::wrapIntoCondition(static::tag('script', '', $options), $condition);
        }

        return static::tag('script', '', $options);
    }

    public static function csrfMetaTags()
    {
        $request = request();
        if ($request instanceof Request && $request->enableCsrfValidation) {
            return static::tag('meta', '', ['name' => 'csrf-param', 'content' => csrf_token()]
                ) . "\n"
                . static::tag('meta', '', ['name' => 'csrf-token', 'content' => csrf_token()]
                ) . "\n";
        }

        return '';
    }

    public static function beginForm($action = '', $method = 'post', $options = [])
    {
        $action = url($action);

        $hiddenInputs = [];

        $request = request();
        if ($request instanceof Request) {
            if (strcasecmp($method, 'get') && strcasecmp($method, 'post')) {
                // simulate PUT, DELETE, etc. via POST
                $hiddenInputs[] = static::hiddenInput($request->methodParam, $method);
                $method = 'post';
            }
            $csrf = Arr::pull($options, 'csrf', true);

            if ($csrf && $request->enableCsrfValidation && strcasecmp($method, 'post') === 0) {
                $hiddenInputs[] = static::hiddenInput(
                    $request->csrfParam,
                    $request->getCsrfToken()
                );
            }
        }

        if (!strcasecmp($method, 'get') && ($pos = strpos($action, '?')) !== false) {
            // query parameters in the action are ignored for GET method
            // we use hidden fields to add them back
            foreach (explode('&', substr($action, $pos + 1)) as $pair) {
                if (($pos1 = strpos($pair, '=')) !== false) {
                    $hiddenInputs[] = static::hiddenInput(
                        urldecode(substr($pair, 0, $pos1)),
                        urldecode(substr($pair, $pos1 + 1))
                    );
                } else {
                    $hiddenInputs[] = static::hiddenInput(urldecode($pair), '');
                }
            }
            $action = substr($action, 0, $pos);
        }

        $options['action'] = $action;
        $options['method'] = $method;
        $form = static::beginTag('form', $options);
        if (!empty($hiddenInputs)) {
            $form .= "\n" . implode("\n", $hiddenInputs);
        }

        return $form;
    }

    public static function hiddenInput($name, $value = null, $options = [])
    {
        return static::input('hidden', $name, $value, $options);
    }

    public static function input($type, $name = null, $value = null, $options = [])
    {
        if (!isset($options['type'])) {
            $options['type'] = $type;
        }
        $options['name'] = $name;
        $options['value'] = $value === null ? null : (string)$value;
        return static::tag('input', '', $options);
    }

    public static function beginTag($name, $options = [])
    {
        if ($name === null || $name === false) {
            return '';
        }

        return "<$name" . static::renderTagAttributes($options) . '>';
    }

    public static function endForm()
    {
        return '</form>';
    }

    public static function a($text, $url = null, $options = [])
    {
        if ($url !== null) {
            $options['href'] = url($url);
        }

        return static::tag('a', $text, $options);
    }

    public static function mailto($text, $email = null, $options = [])
    {
        $options['href'] = 'mailto:' . ($email === null ? $text : $email);
        return static::tag('a', $text, $options);
    }

    public static function img($src, $options = [])
    {
        $options['src'] = url($src);

        if (isset($options['srcset']) && is_array($options['srcset'])) {
            $srcset = [];
            foreach ($options['srcset'] as $descriptor => $url) {
                $srcset[] = url($url) . ' ' . $descriptor;
            }
            $options['srcset'] = implode(',', $srcset);
        }

        if (!isset($options['alt'])) {
            $options['alt'] = '';
        }

        return static::tag('img', '', $options);
    }

    public static function submitButton($content = 'Submit', $options = [])
    {
        $options['type'] = 'submit';
        return static::button($content, $options);
    }

    public static function button($content = 'Button', $options = [])
    {
        if (!isset($options['type'])) {
            $options['type'] = 'button';
        }

        return static::tag('button', $content, $options);
    }

    public static function resetButton($content = 'Reset', $options = [])
    {
        $options['type'] = 'reset';
        return static::button($content, $options);
    }

    public static function buttonInput($label = 'Button', $options = [])
    {
        $options['type'] = 'button';
        $options['value'] = $label;
        return static::tag('input', '', $options);
    }

    public static function submitInput($label = 'Submit', $options = [])
    {
        $options['type'] = 'submit';
        $options['value'] = $label;
        return static::tag('input', '', $options);
    }

    public static function resetInput($label = 'Reset', $options = [])
    {
        $options['type'] = 'reset';
        $options['value'] = $label;
        return static::tag('input', '', $options);
    }

    public static function textInput($name, $value = null, $options = [])
    {
        return static::input('text', $name, $value, $options);
    }

    public static function passwordInput($name, $value = null, $options = [])
    {
        return static::input('password', $name, $value, $options);
    }

    public static function fileInput($name, $value = null, $options = [])
    {
        return static::input('file', $name, $value, $options);
    }

    public static function dropDownList($name, $selection = null, $items = [], $options = [])
    {
        if (!empty($options['multiple'])) {
            return static::listBox($name, $selection, $items, $options);
        }
        $options['name'] = $name;
        unset($options['unselect']);
        $selectOptions = static::renderSelectOptions($selection, $items, $options);
        return static::tag('select', "\n" . $selectOptions . "\n", $options);
    }

    public static function listBox($name, $selection = null, $items = [], $options = [])
    {
        if (!array_key_exists('size', $options)) {
            $options['size'] = 4;
        }
        if (!empty($options['multiple']) && !empty($name) && substr_compare($name, '[]', -2, 2)) {
            $name .= '[]';
        }
        $options['name'] = $name;
        if (isset($options['unselect'])) {
            // add a hidden field so that if the list box has no option being selected, it still submits a value
            if (!empty($name) && substr_compare($name, '[]', -2, 2) === 0) {
                $name = substr($name, 0, -2);
            }
            $hiddenOptions = [];
            // make sure disabled input is not sending any value
            if (!empty($options['disabled'])) {
                $hiddenOptions['disabled'] = $options['disabled'];
            }
            $hidden = static::hiddenInput($name, $options['unselect'], $hiddenOptions);
            unset($options['unselect']);
        } else {
            $hidden = '';
        }
        $selectOptions = static::renderSelectOptions($selection, $items, $options);
        return $hidden . static::tag('select', "\n" . $selectOptions . "\n", $options);
    }

    public static function renderSelectOptions($selection, $items, &$tagOptions = [])
    {
        if (self::isTraversable($selection)) {
            $selection = array_map('strval', $selection);
        }

        $lines = [];
        $encodeSpaces = Arr::pull($tagOptions, 'encodeSpaces', false);
        $encode = Arr::pull($tagOptions, 'encode', true);
        $strict = Arr::pull($tagOptions, 'strict', false);
        if (isset($tagOptions['prompt'])) {
            $promptOptions = ['value' => ''];
            if (is_string($tagOptions['prompt'])) {
                $promptText = $tagOptions['prompt'];
            } else {
                $promptText = $tagOptions['prompt']['text'];
                $promptOptions = array_merge($promptOptions, $tagOptions['prompt']['options']);
            }
            $promptText = $encode ? static::encode($promptText) : $promptText;
            if ($encodeSpaces) {
                $promptText = str_replace(' ', '&nbsp;', $promptText);
            }
            $lines[] = static::tag('option', $promptText, $promptOptions);
        }

        $options = isset($tagOptions['options']) ? $tagOptions['options'] : [];
        $groups = isset($tagOptions['groups']) ? $tagOptions['groups'] : [];
        unset($tagOptions['prompt'], $tagOptions['options'], $tagOptions['groups']);
        $options['encodeSpaces'] = Arr::get($options, 'encodeSpaces', $encodeSpaces);
        $options['encode'] = Arr::get($options, 'encode', $encode);

        foreach ($items as $key => $value) {
            if (is_array($value)) {
                $groupAttrs = isset($groups[$key]) ? $groups[$key] : [];
                if (!isset($groupAttrs['label'])) {
                    $groupAttrs['label'] = $key;
                }
                $attrs = [
                    'options'      => $options,
                    'groups'       => $groups,
                    'encodeSpaces' => $encodeSpaces,
                    'encode'       => $encode,
                    'strict'       => $strict
                ];
                $content = static::renderSelectOptions($selection, $value, $attrs);
                $lines[] = static::tag('optgroup', "\n" . $content . "\n", $groupAttrs);
            } else {
                $attrs = isset($options[$key]) ? $options[$key] : [];
                $attrs['value'] = (string)$key;
                if (!array_key_exists('selected', $attrs)) {
                    $attrs['selected'] = $selection !== null &&
                        (!self::isTraversable($selection) && ($strict ? !strcmp(
                                $key,
                                $selection
                            ) : $selection == $key)
                            || self::isTraversable($selection) && Arr::exists(
                                $selection,
                                (string)$key
                            ));
                }
                $text = $encode ? static::encode($value) : $value;
                if ($encodeSpaces) {
                    $text = str_replace(' ', '&nbsp;', $text);
                }
                $lines[] = static::tag('option', $text, $attrs);
            }
        }

        return implode("\n", $lines);
    }

    public static function isTraversable($var)
    {
        return is_array($var) || $var instanceof Traversable;
    }

    public static function checkboxList($name, $selection = null, $items = [], $options = [])
    {
        if (substr($name, -2) !== '[]') {
            $name .= '[]';
        }
        if (self::isTraversable($selection)) {
            $selection = array_map('strval', $selection);
        }

        $formatter = Arr::pull($options, 'item');
        $itemOptions = Arr::pull($options, 'itemOptions', []);
        $encode = Arr::pull($options, 'encode', true);
        $separator = Arr::pull($options, 'separator', "\n");
        $tag = Arr::pull($options, 'tag', 'div');
        $strict = Arr::pull($options, 'strict', false);

        $lines = [];
        $index = 0;
        foreach ($items as $value => $label) {
            $checked = $selection !== null &&
                (!self::isTraversable($selection) && !strcmp($value, $selection)
                    || self::isTraversable($selection) && Arr::exists($selection, (string)$value));
            if ($formatter !== null) {
                $lines[] = call_user_func($formatter, $index, $label, $name, $checked, $value);
            } else {
                $lines[] = static::checkbox(
                    $name,
                    $checked,
                    array_merge([
                        'value' => $value,
                        'label' => $encode ? static::encode($label) : $label,
                    ], $itemOptions)
                );
            }
            $index++;
        }

        if (isset($options['unselect'])) {
            // add a hidden field so that if the list box has no option being selected, it still submits a value
            $name2 = substr($name, -2) === '[]' ? substr($name, 0, -2) : $name;
            $hiddenOptions = [];
            // make sure disabled input is not sending any value
            if (!empty($options['disabled'])) {
                $hiddenOptions['disabled'] = $options['disabled'];
            }
            $hidden = static::hiddenInput($name2, $options['unselect'], $hiddenOptions);
            unset($options['unselect'], $options['disabled']);
        } else {
            $hidden = '';
        }

        $visibleContent = implode($separator, $lines);

        if ($tag === false) {
            return $hidden . $visibleContent;
        }

        return $hidden . static::tag($tag, $visibleContent, $options);
    }

    public static function checkbox($name, $checked = false, $options = [])
    {
        return static::booleanInput('checkbox', $name, $checked, $options);
    }

    protected static function booleanInput($type, $name, $checked = false, $options = [])
    {
        // 'checked' option has priority over $checked argument
        if (!isset($options['checked'])) {
            $options['checked'] = (bool)$checked;
        }
        $value = array_key_exists('value', $options) ? $options['value'] : '1';
        if (isset($options['uncheck'])) {
            // add a hidden field so that if the checkbox is not selected, it still submits a value
            $hiddenOptions = [];
            if (isset($options['form'])) {
                $hiddenOptions['form'] = $options['form'];
            }
            // make sure disabled input is not sending any value
            if (!empty($options['disabled'])) {
                $hiddenOptions['disabled'] = $options['disabled'];
            }
            $hidden = static::hiddenInput($name, $options['uncheck'], $hiddenOptions);
            unset($options['uncheck']);
        } else {
            $hidden = '';
        }
        if (isset($options['label'])) {
            $label = $options['label'];
            $labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
            unset($options['label'], $options['labelOptions']);
            $content = static::label(
                static::input($type, $name, $value, $options) . ' ' . $label,
                null,
                $labelOptions
            );
            return $hidden . $content;
        }

        return $hidden . static::input($type, $name, $value, $options);
    }

    public static function label($content, $for = null, $options = [])
    {
        $options['for'] = $for;
        return static::tag('label', $content, $options);
    }

    public static function radioList($name, $selection = null, $items = [], $options = [])
    {
        if (self::isTraversable($selection)) {
            $selection = array_map('strval', $selection);
        }

        $formatter = Arr::pull($options, 'item');
        $itemOptions = Arr::pull($options, 'itemOptions', []);
        $encode = Arr::pull($options, 'encode', true);
        $separator = Arr::pull($options, 'separator', "\n");
        $tag = Arr::pull($options, 'tag', 'div');
        $strict = Arr::pull($options, 'strict', false);

        $hidden = '';
        if (isset($options['unselect'])) {
            // add a hidden field so that if the list box has no option being selected, it still submits a value
            $hiddenOptions = [];
            // make sure disabled input is not sending any value
            if (!empty($options['disabled'])) {
                $hiddenOptions['disabled'] = $options['disabled'];
            }
            $hidden = static::hiddenInput($name, $options['unselect'], $hiddenOptions);
            unset($options['unselect'], $options['disabled']);
        }

        $lines = [];
        $index = 0;
        foreach ($items as $value => $label) {
            $checked = $selection !== null &&
                (!self::isTraversable($selection) && !strcmp($value, $selection)
                    || self::isTraversable($selection) && Arr::exists($selection, (string)$value));
            if ($formatter !== null) {
                $lines[] = call_user_func($formatter, $index, $label, $name, $checked, $value);
            } else {
                $lines[] = static::radio(
                    $name,
                    $checked,
                    array_merge([
                        'value' => $value,
                        'label' => $encode ? static::encode($label) : $label,
                    ], $itemOptions)
                );
            }
            $index++;
        }
        $visibleContent = implode($separator, $lines);

        if ($tag === false) {
            return $hidden . $visibleContent;
        }

        return $hidden . static::tag($tag, $visibleContent, $options);
    }

    public static function radio($name, $checked = false, $options = [])
    {
        return static::booleanInput('radio', $name, $checked, $options);
    }

    public static function ol($items, $options = [])
    {
        $options['tag'] = 'ol';
        return static::ul($items, $options);
    }

    public static function ul($items, $options = [])
    {
        $tag = Arr::pull($options, 'tag', 'ul');
        $encode = Arr::pull($options, 'encode', true);
        $formatter = Arr::pull($options, 'item');
        $separator = Arr::pull($options, 'separator', "\n");
        $itemOptions = Arr::pull($options, 'itemOptions', []);

        if (empty($items)) {
            return static::tag($tag, '', $options);
        }

        $results = [];
        foreach ($items as $index => $item) {
            if ($formatter !== null) {
                $results[] = call_user_func($formatter, $item, $index);
            } else {
                $results[] = static::tag(
                    'li',
                    $encode ? static::encode($item) : $item,
                    $itemOptions
                );
            }
        }

        return static::tag(
            $tag,
            $separator . implode($separator, $results) . $separator,
            $options
        );
    }

    public static function activeLabel($model, $attribute, $options = [])
    {
        $for = Arr::pull($options, 'for', static::getInputId($model, $attribute));
        $attribute = static::getAttributeName($attribute);
        $label = Arr::pull(
            $options,
            'label',
            static::encode($model->getAttributeLabel($attribute))
        );
        return static::label($label, $for, $options);
    }

    public static function getInputId($model, $attribute)
    {
        $name = static::getInputName($model, $attribute);
        return static::getInputIdByName($name);
    }

    public static function getInputName($model, $attribute)
    {
        $formName = $model->formName();
        if (!preg_match(static::$attributeRegex, $attribute, $matches)) {
            throw new \Exception('Attribute name must contain word characters only.');
        }
        $prefix = $matches[1];
        $attribute = $matches[2];
        $suffix = $matches[3];
        if ($formName === '' && $prefix === '') {
            return $attribute . $suffix;
        } elseif ($formName !== '') {
            return $formName . $prefix . "[$attribute]" . $suffix;
        }

        throw new \Exception(
            get_class($model) . '::formName() cannot be empty for tabular inputs.'
        );
    }

    public static function getInputIdByName($name)
    {
        $charset = 'UTF-8';
        $name = mb_strtolower($name, $charset);
        return str_replace(['[]', '][', '[', ']', ' ', '.', '--'],
            ['', '-', '-', '', '-', '-', '-'],
            $name);
    }

    public static function getAttributeName($attribute)
    {
        if (preg_match(static::$attributeRegex, $attribute, $matches)) {
            return $matches[2];
        }

        throw new \Exception('Attribute name must contain word characters only.');
    }

    public static function activeHint($model, $attribute, $options = [])
    {
        $attribute = static::getAttributeName($attribute);
        $hint = isset($options['hint']) ? $options['hint'] : $model->getAttributeHint($attribute);
        if (empty($hint)) {
            return '';
        }
        $tag = Arr::pull($options, 'tag', 'div');
        unset($options['hint']);
        return static::tag($tag, $hint, $options);
    }

    public static function errorSummary($models, $options = [])
    {
        $header = isset($options['header']) ? $options['header'] : '<p>' . __(
                'yii',
                'Please fix the following errors:'
            ) . '</p>';
        $footer = Arr::pull($options, 'footer', '');
        $encode = Arr::pull($options, 'encode', true);
        $showAllErrors = Arr::pull($options, 'showAllErrors', false);
        unset($options['header']);
        $lines = self::collectErrors($models, $encode, $showAllErrors);
        if (empty($lines)) {
            // still render the placeholder for client-side validation use
            $content = '<ul></ul>';
            $options['style'] = isset($options['style']) ? rtrim(
                    $options['style'],
                    ';'
                ) . '; display:none' : 'display:none';
        } else {
            $content = '<ul><li>' . implode("</li>\n<li>", $lines) . '</li></ul>';
        }

        return Html::tag('div', $header . $content . $footer, $options);
    }

    private static function collectErrors($models, $encode, $showAllErrors)
    {
        $lines = [];
        if (!is_array($models)) {
            $models = [$models];
        }

        foreach ($models as $model) {
            $lines = array_unique(array_merge($lines, $model->getErrorSummary($showAllErrors)));
        }

        // If there are the same error messages for different attributes, array_unique will leave gaps
        // between sequential keys. Applying array_values to reorder array keys.
        $lines = array_values($lines);

        if ($encode) {
            foreach ($lines as &$line) {
                $line = Html::encode($line);
            }
        }

        return $lines;
    }

    public static function error($model, $attribute, $options = [])
    {
        $attribute = static::getAttributeName($attribute);
        $errorSource = Arr::pull($options, 'errorSource');
        if ($errorSource !== null) {
            $error = call_user_func($errorSource, $model, $attribute);
        } else {
            $error = $model->getFirstError($attribute);
        }
        $tag = Arr::pull($options, 'tag', 'div');
        $encode = Arr::pull($options, 'encode', true);
        return Html::tag($tag, $encode ? Html::encode($error) : $error, $options);
    }

    public static function activeTextInput($model, $attribute, $options = [])
    {
        return static::activeInput('text', $model, $attribute, $options);
    }

    public static function activeInput($type, $model, $attribute, $options = [])
    {
        $name = isset($options['name']) ? $options['name'] : static::getInputName(
            $model,
            $attribute
        );
        $value = isset($options['value']) ? $options['value'] : static::getAttributeValue(
            $model,
            $attribute
        );
        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }

        static::setActivePlaceholder($model, $attribute, $options);
        self::normalizeMaxLength($model, $attribute, $options);

        return static::input($type, $name, $value, $options);
    }

    public static function getAttributeValue($model, $attribute)
    {
        if (!preg_match(static::$attributeRegex, $attribute, $matches)) {
            throw new \Exception('Attribute name must contain word characters only.');
        }
        $attribute = $matches[2];
        $value = $model->$attribute;
        if ($matches[3] !== '') {
            foreach (explode('][', trim($matches[3], '[]')) as $id) {
                if ((is_array($value) || $value instanceof \ArrayAccess) && isset($value[$id])) {
                    $value = $value[$id];
                } else {
                    return null;
                }
            }
        }

        // https://github.com/yiisoft/yii2/issues/1457
        if (is_array($value)) {
            foreach ($value as $i => $v) {
                if ($v instanceof Model) {
                    $v = $v->getPrimaryKey(false);
                    $value[$i] = is_array($v) ? json_encode($v) : $v;
                }
            }
        } elseif ($value instanceof Model) {
            $value = $value->getPrimaryKey(false);

            return is_array($value) ? json_encode($value) : $value;
        }

        return $value;
    }

    protected static function setActivePlaceholder($model, $attribute, &$options = [])
    {
        if (isset($options['placeholder']) && $options['placeholder'] === true) {
            $attribute = static::getAttributeName($attribute);
            $options['placeholder'] = $model->getAttributeLabel($attribute);
        }
    }

    private static function normalizeMaxLength($model, $attribute, &$options)
    {
        if (isset($options['maxlength']) && $options['maxlength'] === true) {
            unset($options['maxlength']);
            $attrName = static::getAttributeName($attribute);
//            foreach ($model->getActiveValidators($attrName) as $validator) {
//                if ($validator instanceof StringValidator && ($validator->max !== null || $validator->length !== null)) {
//                    $options['maxlength'] = max($validator->max, $validator->length);
//                    break;
//                }
//            }
        }
    }

    public static function activePasswordInput($model, $attribute, $options = [])
    {
        return static::activeInput('password', $model, $attribute, $options);
    }

    public static function activeFileInput($model, $attribute, $options = [])
    {
        $hiddenOptions = ['id' => null, 'value' => ''];
        if (isset($options['name'])) {
            $hiddenOptions['name'] = $options['name'];
        }
        // make sure disabled input is not sending any value
        if (!empty($options['disabled'])) {
            $hiddenOptions['disabled'] = $options['disabled'];
        }
        $hiddenOptions = array_merge_recursive(
            $hiddenOptions,
            Arr::pull($options, 'hiddenOptions', [])
        );
        // Add a hidden field so that if a model only has a file field, we can
        // still use isset($_POST[$modelClass]) to detect if the input is submitted.
        // The hidden input will be assigned its own set of html options via `$hiddenOptions`.
        // This provides the possibility to interact with the hidden field via client script.
        // Note: For file-field-only model with `disabled` option set to `true` input submitting detection won't work.

        return static::activeHiddenInput($model, $attribute, $hiddenOptions)
            . static::activeInput('file', $model, $attribute, $options);
    }

    public static function activeHiddenInput($model, $attribute, $options = [])
    {
        return static::activeInput('hidden', $model, $attribute, $options);
    }

    public static function activeTextarea($model, $attribute, $options = [])
    {
        $name = isset($options['name']) ? $options['name'] : static::getInputName(
            $model,
            $attribute
        );
        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
        } else {
            $value = static::getAttributeValue($model, $attribute);
        }
        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }
        self::normalizeMaxLength($model, $attribute, $options);
        static::setActivePlaceholder($model, $attribute, $options);
        return static::textarea($name, $value, $options);
    }

    public static function textarea($name, $value = '', $options = [])
    {
        $options['name'] = $name;
        $doubleEncode = Arr::pull($options, 'doubleEncode', true);
        return static::tag('textarea', static::encode($value, $doubleEncode), $options);
    }

    public static function activeRadio($model, $attribute, $options = [])
    {
        return static::activeBooleanInput('radio', $model, $attribute, $options);
    }

    protected static function activeBooleanInput($type, $model, $attribute, $options = [])
    {
        $name = isset($options['name']) ? $options['name'] : static::getInputName(
            $model,
            $attribute
        );
        $value = static::getAttributeValue($model, $attribute);

        if (!array_key_exists('value', $options)) {
            $options['value'] = '1';
        }
        if (!array_key_exists('uncheck', $options)) {
            $options['uncheck'] = '0';
        } elseif ($options['uncheck'] === false) {
            unset($options['uncheck']);
        }
        if (!array_key_exists('label', $options)) {
            $options['label'] = static::encode(
                $model->getAttributeLabel(static::getAttributeName($attribute))
            );
        } elseif ($options['label'] === false) {
            unset($options['label']);
        }

        $checked = "$value" === "{$options['value']}";

        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }

        return static::$type($name, $checked, $options);
    }

    public static function activeCheckbox($model, $attribute, $options = [])
    {
        return static::activeBooleanInput('checkbox', $model, $attribute, $options);
    }

    public static function activeDropDownList($model, $attribute, $items, $options = [])
    {
        if (empty($options['multiple'])) {
            return static::activeListInput('dropDownList', $model, $attribute, $items, $options);
        }

        return static::activeListBox($model, $attribute, $items, $options);
    }

    protected static function activeListInput($type, $model, $attribute, $items, $options = [])
    {
        $name = Arr::pull($options, 'name', static::getInputName($model, $attribute));
        $selection = Arr::pull($options, 'value', static::getAttributeValue($model, $attribute));
        if (!array_key_exists('unselect', $options)) {
            $options['unselect'] = '';
        }
        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }

        return static::$type($name, $selection, $items, $options);
    }

    public static function activeListBox($model, $attribute, $items, $options = [])
    {
        return static::activeListInput('listBox', $model, $attribute, $items, $options);
    }

    public static function activeCheckboxList($model, $attribute, $items, $options = [])
    {
        return static::activeListInput('checkboxList', $model, $attribute, $items, $options);
    }

    public static function activeRadioList($model, $attribute, $items, $options = [])
    {
        return static::activeListInput('radioList', $model, $attribute, $items, $options);
    }

    public static function addCssClass(&$options, $class)
    {
        if (isset($options['class'])) {
            if (is_array($options['class'])) {
                $options['class'] = self::mergeCssClasses($options['class'], (array)$class);
            } else {
                $classes = preg_split('/\s+/', $options['class'], -1, PREG_SPLIT_NO_EMPTY);
                $options['class'] = implode(' ', self::mergeCssClasses($classes, (array)$class));
            }
        } else {
            $options['class'] = $class;
        }
    }

    private static function mergeCssClasses(array $existingClasses, array $additionalClasses)
    {
        foreach ($additionalClasses as $key => $class) {
            if (is_int($key) && !in_array($class, $existingClasses)) {
                $existingClasses[] = $class;
            } elseif (!isset($existingClasses[$key])) {
                $existingClasses[$key] = $class;
            }
        }

        return static::$normalizeClassAttribute ? array_unique($existingClasses) : $existingClasses;
    }

    public static function removeCssClass(&$options, $class)
    {
        if (isset($options['class'])) {
            if (is_array($options['class'])) {
                $classes = array_diff($options['class'], (array)$class);
                if (empty($classes)) {
                    unset($options['class']);
                } else {
                    $options['class'] = $classes;
                }
            } else {
                $classes = preg_split('/\s+/', $options['class'], -1, PREG_SPLIT_NO_EMPTY);
                $classes = array_diff($classes, (array)$class);
                if (empty($classes)) {
                    unset($options['class']);
                } else {
                    $options['class'] = implode(' ', $classes);
                }
            }
        }
    }

    public static function addCssStyle(&$options, $style, $overwrite = true)
    {
        if (!empty($options['style'])) {
            $oldStyle = is_array($options['style']) ? $options['style'] : static::cssStyleToArray(
                $options['style']
            );
            $newStyle = is_array($style) ? $style : static::cssStyleToArray($style);
            if (!$overwrite) {
                foreach ($newStyle as $property => $value) {
                    if (isset($oldStyle[$property])) {
                        unset($newStyle[$property]);
                    }
                }
            }
            $style = array_merge($oldStyle, $newStyle);
        }
        $options['style'] = is_array($style) ? static::cssStyleFromArray($style) : $style;
    }

    public static function cssStyleToArray($style)
    {
        $result = [];
        foreach (explode(';', $style) as $property) {
            $property = explode(':', $property);
            if (count($property) > 1) {
                $result[trim($property[0])] = trim($property[1]);
            }
        }

        return $result;
    }

    public static function removeCssStyle(&$options, $properties)
    {
        if (!empty($options['style'])) {
            $style = is_array($options['style']) ? $options['style'] : static::cssStyleToArray(
                $options['style']
            );
            foreach ((array)$properties as $property) {
                unset($style[$property]);
            }
            $options['style'] = static::cssStyleFromArray($style);
        }
    }

    public static function escapeJsRegularExpression($regexp)
    {
        $pattern = preg_replace('/\\\\x\{?([0-9a-fA-F]+)\}?/', '\u$1', $regexp);
        $deliminator = substr($pattern, 0, 1);
        $pos = strrpos($pattern, $deliminator, 1);
        $flag = substr($pattern, $pos + 1);
        if ($deliminator !== '/') {
            $pattern = '/' . str_replace('/', '\\/', substr($pattern, 1, $pos - 1)) . '/';
        } else {
            $pattern = substr($pattern, 0, $pos + 1);
        }
        if (!empty($flag)) {
            $pattern .= preg_replace('/[^igmu]/', '', $flag);
        }

        return $pattern;
    }

    public static function box($content, $options = [])
    {
        $tag = Arr::pull($options, 'tag', 'div');
        $type = Arr::pull($options, 'type', 'info');
        $icon = Arr::pull($options, 'icon', '');
        if ($icon) {
            $icon = "<span class='info-box-icon' ><i class='far fa-$icon' ></i ></span >";
        }

        $tpl = "<div class='info-box bg-$type' ></div >";
        $boxContent = static::tag('div', $icon . $content, ['class' => 'info-box-content']);
        return static::tag(
            $tag,
            $boxContent,
            array_merge(['class' => ['info-box', 'bg-' . $type]], $options)
        );
    }
}
