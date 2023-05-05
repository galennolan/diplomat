@extends('layouts.layout')

@section('content')
@include('sweetalert::alert')
<form action="{{route('customer.update', [$customer->id])}}" method="POST">
    @csrf
    @method('PUT')
    <fieldset>
        <legend>Ubah Data Customer</legend>
        <div class="form-group row">
            <div class="col-md-3">
            <label class="font-weight-bold" for="area">1. Area</label>
            <select class="form-control" id="area" name="area">
                <option value="">Please select</option>
                <option value="Semarang" {{ $customer->area == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                <option value="Yogyakarta" {{ $customer->area == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                <option value="Solo" {{ $customer->area == 'Solo' ? 'selected' : '' }}>Solo</option>
            </select>

            </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="rayon">2. Rayon</label>
                <select class="form-control" id="rayon" name="rayon" required>
                    <option value="">Please select</option>
                    <option value="Klaten" {{ $customer->rayon == 'Klaten' ? 'selected' : '' }}>Klaten</option>
                    <option value="Solo" {{ $customer->rayon == 'Solo' ? 'selected' : '' }}>Solo</option>
                    <option value="Sragen" {{ $customer->rayon == 'Sragen' ? 'selected' : '' }}>Sragen</option>
                    <option value="Boyolali" {{ $customer->rayon == 'Boyolali' ? 'selected' : '' }}>Boyolali</option>
                    <option value="Wonogiri" {{ $customer->rayon == 'Wonogiri' ? 'selected' : '' }}>Wonogiri</option>
                    <option value="Yogyakarta" {{ $customer->rayon == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                    <option value="Wonosari" {{ $customer->rayon == 'Wonosari' ? 'selected' : '' }}>Wonosari</option>
                    <option value="Bantul" {{ $customer->rayon == 'Bantul' ? 'selected' : '' }}>Bantul</option>
                    <option value="Purwodadi" {{ $customer->rayon == 'Purwodadi' ? 'selected' : '' }}>Purwodadi</option>
                    <option value="Salatiga" {{ $customer->rayon == 'Salatiga' ? 'selected' : '' }}>Salatiga</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="kab">3. Kabupaten / Kecamatan</label>
                <input type="text" name="kab" id="kab" class="form-control" value="{{$customer->kab}}" required>
            </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="venue">4. Venue</label>
                <select class="form-control" id="venue" name="venue" required>
                    <option value="">Silahkan Pilih</option>
                    <option value="C&B">C&B</option>
                    <option value="KANTOR" @if($customer->venue == 'KANTOR') selected @endif>KANTOR</option>
                    <option value="PA" @if($customer->venue == 'PA') selected @endif>PA</option>
                    <option value="PT" @if($customer->venue == 'PT') selected @endif>PT</option>
                    <option value="R&C" @if($customer->venue == 'R&C') selected @endif>R&C</option>
                    <option value="SC" @if($customer->venue == 'SC') selected @endif>SC</option>
                    <option value="PUSAT PEMBELANJAAN" @if($customer->venue == 'PUSAT PEMBELANJAAN') selected @endif>PUSAT PEMBELANJAAN</option>
                    <option value="WARTEN" @if($customer->venue == 'WARTEN') selected @endif>WARTEN</option>
                </select>
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-3">
                <label class="font-weight-bold" for="name">5. Nama</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{$customer->name}}">
                </div>
        

            <div class="col-md-3">
                <label class="font-weight-bold" for="name">Telp</label>
                    <input id="telp" type="text" name="telp" class="form-control" placeholder ="Kosongin jika tidak ada" value="{{$customer->telp}}">
                </div>

             <div class="col-md-3">
                <label class="font-weight-bold" for="name">IG</label>
                    <input id="IG" type="text" name="IG" class="form-control" placeholder ="Kosongin jika tidak ada" value="{{$customer->IG}}">
                </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="name">Email</label>
                    <input id="email" type="text" name="email" class="form-control" placeholder ="Kosongin jika tidak ada" value="{{$customer->email}}">
            </div>

                

        </div>
        <div class="form-group row">
        <div class="col-md-3">
                    <label class="font-weight-bold" for="jenis_kelamin">6. Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="">Silahkan Pilih</option>
                        <option value="laki-laki" @if($customer->jenis_kelamin == 'laki-laki') selected @endif>L</option>
                        <option value="perempuan" @if($customer->jenis_kelamin == 'perempuan') selected @endif>P</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="font-weight-bold" for="umur_range">7. Umur Range</label>
                    <select class="form-control" id="umur" name="umur" required>
                        <option value="" {{$customer->umur == "" ? "selected" : ""}}>Please select</option>
                        <option value="18-25thn" {{$customer->umur == "18-25thn" ? "selected" : ""}}>18-25thn</option>
                        <option value="26-30thn" {{$customer->umur == "26-30thn" ? "selected" : ""}}>26-30thn</option>
                        <option value="31-40thn" {{$customer->umur == "31-40thn" ? "selected" : ""}}>31-40thn</option>
                        <option value="41-50thn" {{$customer->umur == "41-50thn" ? "selected" : ""}}>41-50thn</option>
                        <option value=">50" {{$customer->umur == ">50" ? "selected" : ""}}>&gt;50</option>
                    </select>
                </div>
                </div>
        <div class="form-group row">
               <div class="col-md-3">
                <label class="font-weight-bold" for="pekerjaan">8. Pekerjaan</label><br>
                <select class="form-control" id="pekerjaan" name="pekerjaan" required>
                    <option value="">Silahkan Pilih</option>
                    <option value="Karyawan" @if($customer->pekerjaan == 'Karyawan') selected @endif>Karyawan</option>
                    <option value="Mahasiswa" @if($customer->pekerjaan == 'Mahasiswa') selected @endif>Mahasiswa</option>
                    <option value="PNS" @if($customer->pekerjaan == 'PNS') selected @endif>PNS</option>
                    <option value="Wiraswasta" @if($customer->pekerjaan == 'Wiraswasta') selected @endif>Wiraswasta</option>
                    <option value="Others" @if($customer->pekerjaan == 'Others') selected @endif>Others</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="merk_rokok">9. Rokok yang dikonsumsi</label>
                <div id="rokok-container">
                    <input type="text" class="form-control @error('rokok-input') is-invalid @enderror" id="rokok" name="rokok" value="{{$customer->rokok}}" required>
                </div>
            </div>


            <div class="col-md-3">
                <label class="font-weight-bold" for="jml_beli">10. Jumlah Beli Rokok Pack</label>
                <select class="form-control" id="jml_beli" name="jml_beli" required>
                    <option value="" {{$customer->jml_beli == "" ? "selected" : ""}}>Please select</option>
                    <option value="0" {{$customer->jml_beli == '0' ? "selected" : ""}}>0</option>
                    <option value="1" {{$customer->jml_beli == '1' ? "selected" : ""}}>1</option>
                    <option value="2" {{$customer->jml_beli == '2' ? "selected" : ""}}>2</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="open">11. Open Teartape</label>
                <select class="form-control" id="open" name="open" required>
                    <option value="" {{$customer->open == "" ? "selected" : ""}}>Please select</option>
                    <option value="0" {{$customer->open == '0' ? "selected" : ""}}>0</option>
                    <option value="1" {{$customer->open == '1' ? "selected" : ""}}>1</option>
                    <option value="2" {{$customer->open == '2' ? "selected" : ""}}>2</option>
                </select>
            </div>


   
        </div>
        <div class="form-group">
        <label class="font-weight-bold" for="pernahrasa">12. Beli Diplomat Mild?</label>
        <select class="form-control" id="pernahrasa" name="pernahrasa" onchange="showDiplomatMildOptions(this.value)" value="{{$customer->pernahrasa}}" required>       
            <option value="">Please select</option>
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
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
                <select class="form-control" name="rasadip" value="{{$customer->rasadip}}" required>       
                    <option value="">Please select</option>
                    <option value="Biasa" {{$customer->rasadip == 'Biasa' ? 'selected' : ''}}>Biasa</option>
                    <option value="Enak" {{$customer->rasadip == 'Enak' ? 'selected' : ''}}>Enak</option>
                    <option value="Tidak Enak" {{$customer->rasadip == 'Tidak Enak' ? 'selected' : ''}}>Tidak Enak</option>
                </select>
            </div>

            <div class="form-group ml-5">
                <label class="font-weight-bold" for="hargadip">Harga</label>
                <select class="form-control bg-light" id="hargadip" name="hargadip" value="{{$customer->hargadip}}"  required>           
                    <option value="">Please select</option>
                    <option value="1" {{$customer->hargadip == 1 ? 'selected' : ''}}>Terjangkau</option>
                    <option value="0" {{$customer->hargadip == 0 ? 'selected' : ''}}>Mahal</option>
                </select>
            </div>

            <div class="form-group ml-5">
                <label class="font-weight-bold" for="kemasan">Kemasan</label>
                <select class="form-control bg-light" id="kemasan" name="kemasan" required>
                    <option value="" {{$customer->kemasan == "" ? "selected" : ""}}>Please select</option>
                    <option value="Menarik" {{$customer->kemasan == "Menarik" ? "selected" : ""}}>Menarik</option>
                    <option value="Tidak Menarik" {{$customer->kemasan == "Tidak Menarik" ? "selected" : ""}}>Tidak Menarik</option>
                </select>
            </div>


     

        <div class="form-group row">
            <div class="col-md-3">
                <label class="font-weight-bold" for="tempatbeli">14. Tempat biasa membeli rokok</label>
                <input type="text" class="form-control" id="tempatbeli" placeholder="Tempat" name="tempatbeli" value="{{$customer->tempatbeli}}" required>
            </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="akanbeli">15. Akan Beli lagi Diplomat Mild?</label>
                <select class="form-control" id="akanbeli" name="akanbeli" required>
                    <option value="" {{$customer->akanbeli == "" ? "selected" : ""}}>Please select</option>
                    <option value="1" {{$customer->akanbeli == "1" ? "selected" : ""}}>Ya</option>
                    <option value="0" {{$customer->akanbeli == "0" ? "selected" : ""}}>Tidak</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="font-weight-bold" for="alasan">16. Alasan</label>
                <select class="form-control" id="alasan" name="alasan" required>
                    <option value="" {{$customer->alasan == "" ? "selected" : ""}}>Please select</option>
                    <option value="Rasa Enak" {{$customer->alasan == "Rasa Enak" ? "selected" : ""}}>Rasa Enak</option>
                    <option value="Rasa Tidak Enak" {{$customer->alasan == "Rasa Tidak Enak" ? "selected" : ""}}>Rasa Tidak Enak</option>
                    <option value="Harga Terjangkau" {{$customer->alasan == "Harga Terjangkau" ? "selected" : ""}}>Harga Terjangkau</option>
                    <option value="Harga Mahal" {{$customer->alasan == "Harga Mahal" ? "selected" : ""}}>Harga Mahal</option>
                    <option value="Kemasan Menarik" {{$customer->alasan == "Kemasan Menarik" ? "selected" : ""}}>Kemasan Menarik</option>
                    <option value="Kemasan Tidak Menarik" {{$customer->alasan == "Kemasan Tidak Menarik" ? "selected" : ""}}>Kemasan Tidak Menarik</option>
                </select>
            </div>


        </div>
    </fieldset>
    <div class="col-md-10">
        <input type="submit" class="btn btn-success btn-send" value="Update">
        <a href="{{ route('customer') }}"><input type="Button" class="btn-primary btn-send" value="Kembali"></a>
    </div>
    <hr>
</form>

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
