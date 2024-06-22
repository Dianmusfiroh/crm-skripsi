
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Edit Projek</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route($modul.'.store') }}" method="POST">
                @csrf

              <div class="modal-body">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama Projek</label>
                    <input class="form-control" type="text" name="name" placeholder="Nama Projek" id="example-text-input">
                </div>
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Divisi</label>
                <select name="divisi" id="" class="form-control">
                    <option value="">Pilih Divisi</option>
                  @foreach ($divisi as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
      </div>
    </div>
