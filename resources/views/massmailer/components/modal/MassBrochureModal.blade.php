
<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Mass Mailing</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="col-9">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table" id="leads-table">
                      <thead>
                        <tr>
                          <th><input type="checkbox" id="select-all-checkbox" /></th>  
                          <th>Company</th>
                          <th>Email</th>
                          <th>Full Name</th>
                          <th>Service</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
              </div>
              <div class="col-3 border border-2 p-2">
                <div class="row align-items-center g-2">
                  <div class="col-9">
                    <select name="service" id="service" class="form-control" onchange="GetLeadsData(this.value)">
                      <option value="">Select Service</option>
                      <option value="Software Development">Software Development</option>
                      <option value="IT Manage Services">IT Manage Services</option>
                      <option value="BPO">BPO</option>
                      <option value="Startup MVP">Startup MVP</option>
                      <option value="Remote Employee Management">Remote Employee Management</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <button class="btn btn-primary" id="send-email-btn" type="button">Send Email</button>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>