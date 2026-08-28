@extends('college-admin::admin.includes.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Contact Inquiries & Notifications</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Inquiries</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title fw-bold text-dark mb-0">All Inquiries & Messages ({{ $contacts->count() }})</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Sender Name</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Received Date</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $index => $contact)
                                        <tr class="{{ $contact->status === 'unread' ? 'table-warning bg-opacity-10' : '' }}">
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>
                                                @if($contact->status === 'unread')
                                                    <span class="badge bg-danger rounded-pill px-3 py-1">New Unread</span>
                                                @else
                                                    <span class="badge bg-secondary rounded-pill px-3 py-1">Read</span>
                                                @endif
                                            </td>
                                            <td class="fw-bold text-dark">{{ $contact->name }}</td>
                                            <td><a href="mailto:{{ $contact->email }}" class="text-decoration-none text-primary">{{ $contact->email }}</a></td>
                                            <td>{{ $contact->subject ?? 'No Subject' }}</td>
                                            <td>{{ $contact->created_at?->format('M d, Y h:i A') ?? 'Recently' }}</td>
                                            <td class="text-center">
                                                <button type="button" 
                                                        class="btn btn-sm btn-primary rounded-pill px-3 me-1" 
                                                        onclick="viewMessage({{ $contact->id }}, '{{ addslashes($contact->name) }}', '{{ addslashes($contact->email) }}', '{{ addslashes($contact->subject ?? '') }}', '{{ addslashes(str_replace(["\r", "\n"], ' ', $contact->message)) }}', '{{ $contact->created_at?->format('F d, Y h:i A') }}')">
                                                    <i class="bi bi-eye"></i> View Message
                                                </button>

                                                <form action="{{ route('admin.contact-inquiries.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<!-- View Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header bg-primary text-white p-4">
                <h5 class="modal-title fw-bold" id="modalSubject">Inquiry Message</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-3 pb-3 border-bottom">
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">Sender Name</label>
                        <p class="fw-bold text-dark mb-0" id="modalName"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">Sender Email</label>
                        <p class="mb-0" id="modalEmail"></p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small fw-bold">Received At</label>
                        <p class="text-muted small mb-0" id="modalDate"></p>
                    </div>
                </div>

                <div>
                    <label class="text-muted small fw-bold mb-2">Message Body</label>
                    <div class="p-3 bg-light rounded-3 border" style="min-height: 120px; white-space: pre-wrap;" id="modalBody"></div>
                </div>
            </div>
            <div class="modal-footer p-3 bg-light">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
@endsection