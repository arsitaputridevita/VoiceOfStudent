<div class="mb-3">
                                <label class="form-label">Departemen</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    @forelse ($departemen as $data)
                                        <option value="{{ $data->id }}" @error('kategori_id') is-invalid @enderror>
                                            {{ $data->kategori }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>