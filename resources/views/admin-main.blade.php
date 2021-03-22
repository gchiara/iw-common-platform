<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        {{ __('Admin panel') }}
    </h2>
    <div class="header-description">From this section it's possible to view and manage datasets, platforms shown in the homepage and registered users.</div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
            <div class="flex list-top-area mb-4">
                <div class="list-title flex-auto text-2xl mb-4">Admin panel</div>
                <div class="list-actions-container flex-auto text-right">
                    <a href="/dataset" class="btn-default btn-large">
                        <i class="fas fa-plus btn-icon-medium"></i>Add new Dataset
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-4">
                <div>
                    <a href="/dashboard">
                        <div class="admin-panel-block datasets-admin-block">
                            <i class="fas fa-server"></i>
                            Manage Datasets
                        </div>
                    </a>
                </div>
                <div>
                    <a href="/platforms-list">
                        <div class="admin-panel-block platforms-admin-block">
                            <i class="fas fa-globe"></i>
                            Manage Platforms
                        </div>
                    </a>
                </div>
                <div>
                    <a href="/users-list">
                        <div class="admin-panel-block users-admin-block">
                            <i class="fas fa-users"></i>
                            Manage Users
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>