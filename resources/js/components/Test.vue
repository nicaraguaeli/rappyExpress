<template>
    <div>
        <h1>Componente ejemplo</h1>
          <input @change="selectFile()"  ref="file" type="file">
<button onclick="">Presione</button>
    </div>
</template>
<script>
import UploadFilesService from "../../../public/js/UploadFilesService";


export default {
    data()
    { 
        return{

            selectedFiles: undefined
        }

    },
    methods: {
    selectFile() {
      this.selectedFiles = this.$refs.file.files;
      UploadFilesService.uploadImage(this.selectedFiles[0]);
   
    }
  }
}
</script>