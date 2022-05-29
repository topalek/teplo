<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('admin.index')}}" class="brand-link">
        <span class="brand-text">{{config('app.name')}}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            {!! App\Helpers\AdminMenuBuilder::buildItems($adminMenu) !!}
        </nav>
    </div>
</aside>
