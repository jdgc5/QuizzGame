<div id="deleteQuizzModal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this question <span id="quizzTitle"></span>?</p>
      </div>
    <form id="formDeleteV3" action="{{('/')}}" method="post" style="display: inline-block">
      @csrf
      @method('delete')
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="formDeleteV3" class="btn btn-primary">Delete Question</button>
      </div>
    </div>
  </div>
</div>