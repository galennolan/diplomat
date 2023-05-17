@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <h1 class="h3 mb-0 text-gray-800">Diplomat Mild Customer Data Form</h1>
 </div>

<hr>
<div class="jumbotron">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">
        <form method="POST" action="{{ route('sales.store') }}">
        @csrf

        <div class="form-group">
                <label class="font-weight-bold" for="area">1. Area</label>
                <select class="form-control"  id="area" name="area" required>
                <option value="">Please select</option>
                    <?php if ($area == 'Semarang'): ?>
                        <option value="Semarang" selected>Semarang</option>
                    <?php elseif ($area == 'Solo'): ?>
                        <option value="Solo" selected>Solo</option>
                    <?php elseif ($area == 'Yogyakarta'): ?>
                        <option value="Yogyakarta" selected>Yogyakarta</option>
                    <?php else: ?>
                        <option value="Semarang">Semarang</option>
                        <option value="Solo">Solo</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                    <?php endif; ?>
                        </select>
              
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="rayon">2. Rayon</label>
                <select class="form-control" id="rayon" name="rayon"  required>
                    <option value="">Please select</option>
                <?php if ($area == 'Solo'): ?>
                    <option value="Klaten">Klaten</option>
                    <option value="Solo" selected>Solo</option>
                    <option value="Sragen">Sragen</option>
                    <option value="Boyolali">Boyolali</option>
                    <option value="Wonogiri">Wonogiri</option>
                <?php elseif ($area == 'Yogyakarta'): ?>
                    <option value="Yogyakarta" selected>Yogyakarta</option>
                    <option value="Wonosari">Wonosari</option>
                    <option value="Bantul">Bantul</option>
                <?php elseif ($area == 'Semarang'): ?>
                    <option value="Semarang">Semarang</option>
                    <option value="Purwodadi">Purwodadi</option>
                    <option value="Salatiga">Salatiga</option>
                <?php endif; ?>
            </select>
            </div> 

            <div class="form-group">
                <label class="font-weight-bold" for="kab">3. Kabupaten / Kecamatan</label>
                <input type="text" name="kab" id="kab" class="form-control" value="{{ old('kab') }}" required>
               
            </div>            
            <div class="form-group">
                <label class="font-weight-bold" for="venue">4. Venue</label>
                <select class="form-control" id="venue" name="venue" required>
                    <option value="">Silahkan Pilih</option>
                    <option value="C&B">C&B</option>
                    <option value="KANTOR" @if(old('venue') == 'KANTOR') selected @endif>KANTOR</option>
                    <option value="PA" @if(old('venue') == 'PA') selected @endif>PA</option>
                    <option value="PT" @if(old('venue') == 'PT') selected @endif>PT</option>
                    <option value="R&C" @if(old('venue') == 'R&C') selected @endif>R&C</option>
                    <option value="SC" @if(old('venue') == 'SC') selected @endif>SC</option>
                    <option value="PUSAT PEMBELANJAAN" @if(old('venue') == 'PUSAT PEMBELANJAAN') selected @endif>PUSAT PEMBELANJAAN</option>
                    <option value="WARTEN" @if(old('venue') == 'WARTEN') selected @endif>WARTEN</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">5. Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"placeholder="Silahkan diisi" required>
            </div>

            <!-- <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">6. No Telp/Email/IG/FB</label>
                <input type="text" name="telp" id="telp" class="form-control" placeholder="Silahkan diisi" required>
            </div> -->

            <div class="form-group">
                <label class="font-weight-bold" for="cust-data">6. Customer Contact</label>
                <select class="form-control" id="cust-data" name="cust-data" required>
                    <option value="">Please select</option>
                    <option value="telp">Phone Number</option>
                    <option value="IG">Instagram</option>
                    <option value="EMAIL">Email</option>
                </select>

                <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" style="display: none;">
                <input type="text" class="form-control @error('IG') is-invalid @enderror" id="IG" name="IG" style="display: none;">
                <input type="text" class="form-control @error('EMAIL') is-invalid @enderror" id="EMAIL" name="EMAIL" style="display: none;">

                @error('telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @error('IG')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @error('EMAIL')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="jenis_kelamin">7. Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="">Silahkan Pilih</option>
                    <option value="laki-laki" @if(old('jenis_kelamin') == 'laki-laki') selected @endif>L</option>
                    <option value="perempuan" @if(old('jenis_kelamin') == 'perempuan') selected @endif>P</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">8. Umur</label>
                <select class="form-control" id="umur" name="umur" required >
                    <option value="">Please select</option>
                    <option value="18-25thn" @if(old('umur') == '18-25thn') selected @endif>18-25thn</option>
                    <option value="26-30thn" @if(old('umur') == '26-30thn') selected @endif>26-30thn</option>
                    <option value="31-40thn" @if(old('umur') == '31-40thn') selected @endif>31-40thn</option>
                    <option value="41-50thn" @if(old('umur') == '41-50thn') selected @endif>41-50thn</option>
                    <option value=">50" @if(old('umur') == '>50thn') selected @endif>>50</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlSelect1">9. Pekerjaan</label><br>
                <select class="form-control" id="pekerjaan" name="pekerjaan" required>
                    <option value="">Silahkan Pilih</option>
                    <option value="Karyawan" @if(old('pekerjaan') == 'Karyawan') selected @endif>Karyawan</option>
                    <option value="Mahasiswa" @if(old('pekerjaan') == 'Mahasiswa') selected @endif>Mahasiswa</option>
                    <option value="PNS" @if(old('pekerjaan') == 'PNS') selected @endif>PNS</option>
                    <option value="Wiraswasta" @if(old('pekerjaan') == 'Wiraswasta') selected @endif>Wiraswasta</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="merk_rokok">10. Rokok yang dikonsumsi selama ini</label>
                <div id="rokok-container">
                    <select class="form-control" id="rokok" name="rokok" required>              
                        <option value="">Please select</option>
                        <option value="Diplomat Mild" @if(old('rokok') == 'Diplomat Mild') selected @endif>Diplomat Mild</option>
                        <option value="Diplomat Mild Menthol" @if(old('rokok') == 'Diplomat Mild Menthol') selected @endif>Diplomat Mild Menthol</option>
                        <option value="Pro Mild" @if(old('rokok') == 'Pro Mild') selected @endif>Pro Mild</option>
                        <option value="Class Mild" @if(old('rokok') == 'Class Mild') selected @endif>Class Mild</option>
                        <option value="A Mild" @if(old('rokok') == 'A Mild') selected @endif>A Mild</option>
                        <option value="other">other</option>
                    </select>
                    <input type="text" class="form-control @error('rokok-input') is-invalid @enderror" id="rokok-input" name="rokok-input" style="display: none;">

                </div>
            </div>


            <div class="form-group">
                <label class="font-weight-bold" for="jml_beli">11. Jumlah Beli Rokok Pack</label>
                <select class="form-control" id="jml_beli" name="jml_beli" required>       
                    <option value="">Please select</option>
                    <option value="0" @if(old('jml_beli') == '0') selected @endif>0</option>
                    <option value="1" @if(old('jml_beli') == '1') selected @endif>1</option>
                    <option value="2" @if(old('jml_beli') == '2') selected @endif>2</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="open">Open Teartape</label>
                <select class="form-control" id="open" name="open" required>       
                    <option value="">Please select</option>
                    <option value="0" @if(old('open') == '0') selected @endif>0</option>
                    <option value="1"@if(old('open') == '1') selected @endif>1</option>
                    <option value="2"@if(old('open') == '2') selected @endif>2</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="pernahrasa">12. Beli Diplomat Mild? </label>
                <select class="form-control" id="pernahrasa" name="pernahrasa" onchange="showDiplomatMildOptions()" required>       
                    <option value="">Please select</option>
                    <option value="1" @if(old('pernahrasa') == '1') selected @endif>Ya</option>
                    <option value="0" @if(old('pernahrasa') == '0') selected @endif>Tidak</option>
                </select>
                </div>
                
                <div class="form-group">
                <div id="diplomatMildOptions" style="display:none;">
                    <label class="font-weight-bold" for="diplomatMildRasa">Pilih rasa Diplomat Mild</label>
                    <select class="form-control" id="pernahrasa" name="pernahrasa">
                        <option value="">Please select</option>
                        <option value="Diplomat Mild">Diplomat Mild</option>
                        <option value="Diplomat Mild Menthol">Diplomat Mild Menthol</option>
                    </select>
                </div>
            </div>

            <label class="font-weight-bold">13. Diplomat Mild</label>

            <div class="form-group ml-5">
                <label class="font-weight-bold" for="rasadip">Rasa</label>
                <select class="form-control" name="rasadip" required>       
                    <option value="">Please select</option>
                    <option value="Biasa">Biasa</option>
                    <option value="Enak">Enak</option>
                    <option value="Tidak Enak">Tidak Enak</option>
                </select>

            </div>

            <div class="form-group ml-5">
                <label class="font-weight-bold" for="hargadip">Harga</label>
                <select class="form-control bg-light" id="hargadip" name="hargadip" required>           
                    <option value="">Please select</option>
                    <option value="1">Terjangkau</option>
                    <option value="0">Mahal</option>
                </select>
            </div>

            <div class="form-group ml-5">
                <label class="font-weight-bold" for="kemasan">Kemasan</label>
                <select class="form-control bg-light" id="kemasan" name="kemasan" required>           
                    <option value="">Please select</option>
                    <option value="Menarik">Menarik</option>
                    <option value="Tidak Menarik">Tidak Menarik</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="tempatbeli">14. Tempat biasa membeli rokok</label>
                <input type="text" class="form-control" id="tempatbeli" placeholder="Tempat" name="tempatbeli" required>       
            </div>

            

            <div class="form-group">
                <label class="font-weight-bold" for="akanbeli">15. Apakah akan membeli Diplomat Mild Lagi</label>
                <select class="form-control" id="akanbeli" name="akanbeli" required>       
                    <option value="" selected>Please select</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="alasan">16. Alasan</label>
                <select class="form-control" id="alasan" name="alasan" required>       
                    <option value="" >Please select</option>
                    <option value="Rasa Enak">Rasa Enak</option>
                    <option value="Rasa Tidak Enak">Rasa Tidak Enak</option>
                    <option value="Harga Terjangkau">Harga Terjangkau</option>
                    <option value="Harga Mahal">Harga Mahal</option>
                    <option value="Kemasan Menarik">Kemasan Menarik</option>
                    <option value="Kemasan Tidak Menarik">Kemasan Tidak Menarik</option>
                </select>
            </div>
        <div class="modal-footer">

            <input type="submit" class="btn btn-danger btn-send" value="Simpan">
        </div>
    </form>

</div>
</div>
</div>



 

 
 <script>
  const rokokContainer = document.getElementById("rokok-container");
const rokokSelect = document.getElementById("rokok");
const rokokInput = document.getElementById("rokok-input");

rokokSelect.addEventListener("change", function() {
    if (rokokSelect.value === "other") {
        rokokSelect.style.display = "none";
        rokokInput.style.display = "block";
        rokokInput.value = "";
        rokokInput.setAttribute("name", "rokok"); // set the name attribute dynamically
    } else {
        rokokInput.style.display = "none";
        rokokSelect.style.display = "block";
        rokokInput.removeAttribute("name"); // remove the name attribute when hidden
    }
});


</script>

<script>
    const select = document.getElementById("cust-data");

const input = document.getElementById("contact-value");

select.addEventListener("change", function() {
  const selectedValue = select.value;
  if (selectedValue === "IG") {
    input.setAttribute("id", "IG");
  } else if (selectedValue === "email") {
    input.setAttribute("id", "email");
  } else {
    input.removeAttribute("id");
  }
});

</script>

<script>
    // When the select box value changes
    $('#cust-data').change(function() {
        // Hide all the input fields
        $('#telp').hide();
        $('#IG').hide();
        $('#EMAIL').hide();

        // Get the selected option value
        var selected = $(this).val();

        // Show the corresponding input field based on the selected option
        if (selected == 'telp') {
            $('#telp').show();
        } else if (selected == 'IG') {
            $('#IG').show();
        } else if (selected == 'EMAIL') {
            $('#EMAIL').show();
        }
    });
</script>


<script>
    
//diplomat mild and diplomat mild 
    function showDiplomatMildOptions() {
        var pernahrasaSelect = document.getElementById("pernahrasa");
        var diplomatMildOptionsDiv = document.getElementById("diplomatMildOptions");
        if (pernahrasaSelect.value === "1") {
            diplomatMildOptionsDiv.style.display = "block";
        } else {
            diplomatMildOptionsDiv.style.display = "none";
        }
    }
</script>
@endsection
