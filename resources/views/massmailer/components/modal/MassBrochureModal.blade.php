
<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header mailing-header">
            <h5 class="modal-title">Mass Brochure Email Campaign</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="col-9">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table" id="leads-table">
                      <thead>
                        <tr>
                          <th>Company</th>
                          <th>Email</th>
                          <th>Full Name</th>
                          <th>Service</th>
                          <th><input type="checkbox" id="select-all-checkbox" /></th>  
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
              </div>
              <div class="col-3 border border-2 p-2">
                <div class="row align-items-center g-2">
                  <label for="">Services</label>
                  <div class="col-12">
                    <select name="service" id="service" class="form-control" onchange="GetLeadsData(this.value)">
                      <option value="">Select Service</option>
                      <option value="Software Development">Software Development</option>
                      <option value="IT Managed Services">IT Managed Services</option>
                      <option value="BPO">BPO</option>
                      <option value="Startup MVP">Startup MVP</option>
                      <option value="Remote Employee Management">Remote Employee Management</option>
                      <option value="Offshore Remote Team">Offshore Remote Team
                      </option>
                    </select>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" id="send-email-btn" type="button">Send Email</button>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>