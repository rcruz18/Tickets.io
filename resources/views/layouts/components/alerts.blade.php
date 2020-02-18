<div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible fade show" role="alert">
    <span class="alert-inner--icon mr-3"><i class="fa {{ session('icon') ?? 'fa-info-circle' }}"></i></span>
    <span class="alert-inner--text"><strong>{{ session('strong') ?? 'Success!' }}</strong> {{ session('status') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
