@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Kamu Berhasil Login ya, :name sebagai :role', ['name' => Auth::user()->name,'role'=> Auth::user()->getRoleNames()->first()])  }}

                
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function toggleInputField() {
  const dropdown = document.getElementById("dropdown");
  const otherInput = document.getElementById("otherInput");
  
  if (dropdown.value === "other") {
    dropdown.style.display = "none";
    otherInput.style.display = "block";
    otherInput.value = ""; // clear previous input value
  } else {
    dropdown.style.display = "block";
    otherInput.style.display = "none";
  }
}

</script>
@endsection
