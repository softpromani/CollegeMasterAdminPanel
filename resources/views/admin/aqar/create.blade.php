@extends('college-admin::admin.includes.master')

@section('content')

<div class="pagetitle">

    <h1>

        {{ isset($aqar)
            ? 'Edit AQAR'
            : 'Create AQAR'
        }}

    </h1>

</div>

<section class="section">

    <div class="card">

        <div class="card-body mt-4">

            <form
                action="{{ isset($aqar)
                    ? route('admin.aqar.update',$aqar->id)
                    : route('admin.aqar.store') }}"
                method="POST"
            >

                @csrf

                @if(isset($aqar))
                    @method('PUT')
                @endif

                <div class="row">

                    <div class="col-md-4">

                        <x-input-box
                            label="AQAR Name"
                            name="name"
                            type="text"
                            :value="old('name',$aqar->name ?? '')"
                        />

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-warning mt-3"
                >

                    Save

                </button>

            </form>

        </div>

    </div>

</section>

@endsection
