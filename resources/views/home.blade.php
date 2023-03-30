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

                    {{ __('You are logged in!') }}
                    <form>
                    <label for="dropdown">Select an option:</label>
                    <select id="dropdown" name="dropdown" onchange="toggleInputField()">
                        <option value="regular">Regular option</option>
                        <option value="note">Note</option>
                        <option value="joko">Joko</option>
                        <option value="saryono">Saryono</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="text" id="otherInput" name="otherInput" style="display: none;">
                    <input type="submit" value="Submit">
                    </form>


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
