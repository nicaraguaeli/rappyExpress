<template>
     <div class="modal fade" id="centralModalSuccessDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-notify modal-success" role="document">
            <!-- Content -->
            <div class="modal-content">
              <!-- Header -->
              <div class="modal-header">
                <p class="heading lead" v-text="title"></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">×</span>
                </button>
              </div>

              <!-- Body -->
              <div class="modal-body">
                <div class="text-center">
                  <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                  <p v-text="text">
                  </p>
                </div>
              </div>

              <!-- Footer -->
              <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-success waves-effect waves-light close"  data-dismiss="modal" aria-label="Close">Entendido </a>
              
              </div>
            </div>
            <!-- Content -->
          </div>
        </div>
</template>
<script>
export default {
  mounted()
  {
      if(this.modalstate)
      {
           $('#centralModalSuccessDemo').modal('show')
      }
      
  },
    
    props:
    {
        title: "",
        text: "",
        modalstate: Boolean

    },
  
    
  }

</script>