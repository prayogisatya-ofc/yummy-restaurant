<div class="modal fade" id="modalBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 fw-bold text-white" id="exampleModalLabel">Book Your Stay With Us</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select name="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="">Select type ---</option>
                            <option value="table">Table</option>
                            <option value="event">Event</option>
                            <option value="menu">Menu</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-4 col-md-6">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Your Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                placeholder="Your Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                                placeholder="Your Phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                placeholder="Date">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" id="time"
                                placeholder="Time">
                            @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="number" class="form-control @error('people') is-invalid @enderror" name="people" id="people"
                                placeholder="# of people">
                            @error('people')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" accept="image/*">
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <textarea class="form-control @error('messages') is-invalid @enderror" name="messages" rows="5" placeholder="Message"></textarea>
                        @error('messages')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
