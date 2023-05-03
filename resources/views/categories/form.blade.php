<div class="modal" id="addcat" class="addcat" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="catname" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                    <label for="Permanlink">Permanlink:</label>
                    <input type="text" class="form-control" id="catpermalink" name="Permalink">
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea class="form-control" id="catdescription" placeholder="Description" rows="3"
                              name="Description"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="catstatus" name="status" value="1">
                </div>
                <div id="successAdminadd" class="alert alert-success hide basicSetMessages"></div>
                <div id="errorAdminadd" class="alert alert-danger hide basicSetMessages"></div>
                <button type="submit" id="addCategory" class="btn btn-primary ">Add Category</button>

            </div>

        </div>
    </div>
</div>
<!-- add category modal end-->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                    <label for="Permanlink">Permanlink:</label>
                    <input type="text" class="form-control" id="permalink" name="Permanlink">
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea rows="3" class="form-control" id="description" placeholder="Description"
                              name="Description"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id" name="id">
                </div>
                <div id="successAdmin" class="alert alert-success hide basicSetMessages"></div>
                <div id="errorAdmin" class="alert alert-danger hide basicSetMessages"></div>
                <button type="submit" id="updateCategory" class="btn btn-primary ">Update</button>

            </div>

        </div>
    </div>
</div>
