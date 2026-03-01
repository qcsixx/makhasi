<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>feed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Edit feed</h3>
    </div>
   <div class="container">   
      <div class= "row justify-content-center mt-4">
      <div class="col-md-10 d-flex justify-content-end">
          <a href="{{ route('feed') }}" class="btn btn-dark">Back</a>
      </div>
  </div>
        <div class="row d-flex justifiy-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Feed</h3>
                </div>
                <form enctype="multipart/form-data" action="{{ route('update',$makanan->id) }}" method="post">
                  @method('put')
                    @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label h5">Nama</label>
                    <input value="{{ old('nama',$makanan->nama) }}" type="text" class="@error('nama') is-invalid @enderror 
                    form-control form-control-lg"  placeholder="Nama" name="nama">
                    @error('nama')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                 </div>
                 <div class="mb-3">
                  <label for="daerah_id" class="form-label h5">Daerah</label>
                  <select id="daerah_id" value="{{ old('daerah') }}" type="text" class="@error('daerah') is-invalid @enderror 
                  form-control form-control-lg"  placeholder="Daerah" 
                  name="daerah_id">
                  <option value="1">Sumatra</option>
                  <option value="2">Jawa</option>
                  <option value="3">Kalimantan</option>
                  <option value="4">Sulawesi</option>
                  <option value="5">Papua</option>
                  @error('daerah')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                  </select>
                 </div>
                 <div class="mb-3">
                    <label for="" class="form-label h5">Deskripsi</label>
                    <textarea placeholder="deskripsi" class="form-control" name="deskripsi" cols="30" rows="5">{{ old('deskripsi') }}</textarea>
                  </div>
                 <div class="mb-3">
                    <label for="" class="form-label h5">Resep</label>
                    <textarea placeholder="Resep" class="form-control" name="resep" cols="30" rows="5"></textarea>
                 </div>
                 <div class="mb-3">
                    <label for="" class="form-label h5">Panduan</label>
                    <textarea placeholder="Panduan" class="form-control" name="panduan" cols="30" rows="5"></textarea>
                 </div>
                 <div class="mb-3">
                    <label for="" class="form-label h5">Image</label>
                    <input type="file" class="form-control form-control-lg"  placeholder="input" 
                    name="image">

                    @if ($makanan->image !="")
                            <img class="w-50 my-3" src="{{ asset('images/' . $makanan->image) }}" alt="">
                            @endif
                 </div>
                 <div class="d-grid">
                    <button class="btn btn-lg btn-primary">Update</button>
                </div>
             </div>
          </div> 
         </form>
       </div>
      </div>
   </div>
</div> 

  </body>
</html>