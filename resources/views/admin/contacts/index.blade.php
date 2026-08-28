@extends('college-admin::admin.includes.master')
@section('title', 'Contact Inquiries')

@section('header-area')
<style>
    .card{
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(12px);
    }
</style>
@endsection

@section('content')
<div class="pagetitle d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold">Contact Inquiries & Messages</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Inquiries</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <x-data-table
                id="contact-table"
                :columns="$columns"
                :ajax="route('admin.contact-inquiries.index')"
            />
        </div>
    </div>
</section>

<!-- View Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header bg-primary text-white p-4">
                <h5 class="modal-title fw-bold text-white" id="modalSubject">Inquiry Message</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-3 pb-3 border-bottom">
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">Sender Name</label>
                        <p class="fw-bold text-dark mb-0 fs-6" id="modalName"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">Sender Email</label>
                        <p class="mb-0 fs-6" id="modalEmail"></p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small fw-bold">Received Date & Time</label>
                        <p class="text-muted small mb-0" id="modalDate"></p>
                    </div>
                </div>

                <div>
                    <label class="text-muted small fw-bold mb-2">Message Body</label>
                    <div class="p-3 bg-light rounded-3 border" style="min-height: 120px; white-space: pre-wrap; font-size: 15px;" id="modalBody"></div>
                </div>
            </div>
            <div class="modal-footer p-3 bg-light">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function viewMessage(id, name, email, subject, message, date) {
    document.getElementById('modalName').innerText = name;
    document.getElementById('modalEmail').innerHTML = `<a href="mailto:${email}" class="fw-semibold text-primary">${email}</a>`;
    document.getElementById('modalSubject').innerText = subject ? subject : 'Contact Inquiry';
    document.getElementById('modalDate').innerText = date;
    document.getElementById('modalBody').innerText = message;

    // Send async status update to mark as read
    fetch(`{{ url('admin/contact-inquiries') }}/${id}`);

    const modal = new bootstrap.Modal(document.getElementById('messageModal'));
    modal.show();
}
</script>
@endpush
@endsection