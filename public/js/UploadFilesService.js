import http from "../js/http-common";

class UploadFilesService {
  uploadMedia(file, onUploadProgress) {
    let formData = new FormData();
    
    formData.append("file", file);
    formData.append("nombre", "eli");
    formData.append('_method', 'PUT');

    axios.post("/deliveryApp/public/categoria/"+1, formData, {
      headers: {
        "Content-Type": "multipart/form-data"
      },
    
      onUploadProgress
    }).then(response => (console.log(response.data)));
}

uploadImage(file){

    this.uploadMedia(file, event => {
        console.log(Math.round((100 * event.loaded) / event.total));
      })

}
  

 
  getFiles() {
    return http.get("/files");
  }
}

export default new UploadFilesService();


