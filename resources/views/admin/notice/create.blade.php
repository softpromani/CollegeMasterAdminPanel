@extends('admin.includes.master')

@section('header-area')

<style>

    .card{
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(12px);
    }

</style>

@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

        {{ isset($notice) ? 'Edit Notice' : 'Create Notice' }}

    </h1>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <form
                action="{{ isset($notice)
                    ? route('admin.notice.update',$notice->id)
                    : route('admin.notice.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @if(isset($notice))
                    @method('PUT')
                @endif

                <div class="row align-items-end">

                    {{-- Title --}}
                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Title"
                            name="title"
                            type="text"
                            placeholder="Enter Title"
                            :value="old('title',$notice->title ?? '')"
                        />

                    </div>

                    {{-- Category --}}
                    <div class="col-md-4 mb-4">

                        <x-select-box
                            label="Notice Category"
                            name="category"
                            :options="[
                                'General',
                                'Exam',
                                'Admission',
                                'Holiday'
                            ]"
                            :selected="old('category',$notice->category ?? '')"
                        />

                    </div>

                    {{-- Notice Type --}}
                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-semibold mb-3">

                            Notice Type

                        </label>

                        <div class="d-flex gap-4">

                            <div class="form-check">

                                <input
                                    class="form-check-input notice-type"
                                    type="radio"
                                    name="type"
                                    value="file"

                                    {{ old('type') == 'file' ? 'checked' : '' }}
                                >

                                <label class="form-check-label">

                                    File

                                </label>

                            </div>

                            <div class="form-check">

                                <input
                                    class="form-check-input notice-type"
                                    type="radio"
                                    name="type"
                                    value="link"

                                    {{ old('type') == 'link' ? 'checked' : '' }}
                                >

                                <label class="form-check-label">

                                    Link

                                </label>

                            </div>

                        </div>

                    </div>

                    {{-- File Upload --}}
                    <div
                        class="col-md-4 mb-4"
                        id="file-box"
                        style="display:none;"
                    >

                        <x-input-box
                            label="Upload File"
                            name="file"
                            type="file"
                        />

                    </div>

                    {{-- Link Field --}}
                    <div
                        class="col-md-4 mb-4"
                        id="link-box"
                        style="display:none;"
                    >

                        <x-input-box
                            label="Enter Link"
                            name="link"
                            type="text"
                            placeholder="Enter Link"
                            :value="old('link')"
                        />

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-warning rounded-pill px-5 shadow-sm fw-semibold"
                >

                    {{ isset($notice)
                        ? 'Update Notice'
                        : 'Save Notice'
                    }}

                </button>

            </form>

        </div>

    </div>

</section>

@endsection


@section('script-area')

<script>

    function toggleFields(type){

        if(type === 'file'){

            $('#file-box').show();
            $('#link-box').hide();

        }
        else if(type === 'link'){

            $('#link-box').show();
            $('#file-box').hide();

        }

    }

    $(document).ready(function(){

        let selectedType = $('.notice-type:checked').val();

        toggleFields(selectedType);

        $('.notice-type').on('change', function(){

            toggleFields($(this).val());

        });

    });

</script>

@endsection
