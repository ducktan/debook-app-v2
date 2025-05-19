@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - Comment Management')

@section('css')
    @vite(['resources/css/admin/userSetting.css'])
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('pages.admin.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @include('pages.admin.resItem')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-chat-dots-fill me-2 text-primary"></i>QUẢN LÝ BÌNH LUẬN
                </h2>
            </div>

            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Người dùng</th>
                                    <th>Sản phẩm</th>
                                    <th>Nội dung</th>
                                    <th>Đánh giá</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->user->name ?? 'Không rõ' }}</td>
                                        <td>{{ $comment->product->title ?? 'Không rõ' }}</td>
                                        <td>{{ Str::limit($comment->content, 50) }}</td>
                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                {{ $comment->rating }}/5
                                            </span>
                                        </td>
                                        <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm delete-comment-btn" data-id="{{ $comment->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <nav class="mt-4">
                {{ $comments->links('pagination::bootstrap-5') }}
            </nav>
        </main>
    </div>
</div>
@endsection

@section('js')
    @vite(['resources/js/admin/comment.js'])
@endsection
