<div class="modal fade" id="modalBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 fw-bold text-white" id="exampleModalLabel">Book Your Stay With Us</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking') }}" method="post" role="form" class="php-email-form">
                    @csrf
                    <div class="mb-3">
                        <select name="type" class="form-select" required>
                            <option value="">Select type ---</option>
                            <option value="table">Table</option>
                            <option value="event">Event</option>
                            <option value="menu">Menu</option>
                        </select>
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-4 col-md-6">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Your Name" required="">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Your Email" required="">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="Your Phone" required="">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="date" name="date" class="form-control" id="date"
                                placeholder="Date" required="">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="time" class="form-control" name="time" id="time"
                                placeholder="Time" required="">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="number" class="form-control" name="people" id="people"
                                placeholder="# of people" required="">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                    </div>

                    <div class="text-center mt-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">
                            Your booking request was sent. We will call back or send an
                            Email to confirm your reservation. Thank you!
                        </div>
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
