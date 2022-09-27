
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet"
/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" integrity="sha512-0SPWAwpC/17yYyZ/4HSllgaK7/gg9OlVozq8K7rf3J8LvCjYEEIfzzpnA2/SSjpGIunCSD18r3UhvDcu/xncWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<div id="adi">
  <div v-scope="filep()" @vue:mounted="mounted" v-cloak class="col-md-8 payout-tab  mb-2" data-select2-id="20">
    <div class="nav-tabs-custom " id="form_tabs" data-select2-id="form_tabs">
      <ul class="nav nav-tabs " role="tablist">
        <li role="presentation" class="nav-item">
          <a @click.prevent="changeTab(0)" :class="tab === 0 ? 'active nav-link' : 'nav-link'">Info</a>
        </li>
         <li role="presentation" class="nav-item">
          <a @click.prevent="changeTab(1)" :class="tab === 1 ? 'active nav-link' : 'nav-link'">Gallery</a>
        </li>
    
      </ul>
      <div class="tab-content p-0 " data-select2-id="19">
 <div v-show="tab === 0"  role="tabpanel" :class="tab === 0 ? 'active tab-pane' : 'tab-pane'" id="tab-info" data-select2-id="tab_chip-gallery">
 <div id="goHere">

 </div>
</div>

 <div  role="tabpanel" v-show="tab === 1" :class="tab === 1 ? 'active tab-pane' : 'tab-pane'" id="tab_chip-gallery" data-select2-id="tab_chip-gallery">
  <div class="col-md-12"> 
  <input   type="file" ref="images" name="image" multiple id="monggi" />
  </div>

  <div class="d-flex  flex-wrap" >
  <div class="p-1 container" v-for="(img, index) in gallery" >
    <i @click.prevent="deleteImage(img.id)"  class="d-flex rounded" style="cursor:pointer; background:#7c69ef; color:white; margin-left:5px; margin-top:5px;  padding:0px 4px; z-index:50000; font-size:15px; font-weight:bold; position: absolute;">x</i>
  <img  v-scope="lightBox()"  @mouseover="mounted($el)" @mouseleave="unmounted($el)" class="rounded image thumbnail" :src="img.thumbnail" /> 
</div>

  </div>


</div>
      </div>

    </div>

  </div>
</div>
<script>
</script>




<script defer src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script defer src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
<script defer src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script defer src="https://unpkg.com/filepond/dist/filepond.js"></script>




<script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>

  <script>


   
    $(document).ready(function () {

    
  const bold = document.querySelector('.bold-labels');
    const go = document.querySelector('#goHere');
    let miniVar = bold.innerHTML;
    bold.innerHTML = '';
    go.innerHTML = miniVar
  
    })

    </script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="module">

  import {
    createApp
  } from 'https://unpkg.com/petite-vue?module'



  function lightBox(props)
  {
    return {
    
      mounted(element)
      {
        console.log(element.classList)

        // console.log(element)
      },

      unmounted(element)
      {

        // console.log(element)
      }
    }

  }

  function filep(props) {
    return { 
    filepond: null,
    gallery: [],
  async deleteImage(id)
      {
      await axios.delete('/api/events/gallery/delete/' +id ).then((res) => {
        this.gallery = res.data
      })
      },
    async changeTab(tab)
    {
      this.tab= tab
    },
    async fetchGallery()
    {
    await axios.get('/api/events/gallery/fetch/' + {{ $widget['eventId'] }}).then((res) => {
      this.gallery = res.data
      })
    },
    mounted() {
    this.tab = 0

  // FilePond.registerPlugin(FilePondPluginImagePreview)
    // FilePond.registerPlugin(FilePondPluginImageCrop);
    // FilePond.registerPlugin(FilePondPluginImageTransform);

    this.fetchGallery();


    const inputElement = document.querySelector('#monggi');


    const pond = FilePond.create(inputElement);
  
        this.filepond = pond;
     
    this.filepond.setOptions({
      allowRevert: false,

        server: {
        
          process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {

           
            const formData = new FormData();

            formData.append('event_id',  {{ $widget['eventId'] }} ) 

            formData.append(fieldName, file, file.name);

            const request = new XMLHttpRequest();
            request.open('POST', '/api/events/gallery/upload');

            request.upload.onprogress = (e) => {
              progress(e.lengthComputable, e.loaded, e.total);
              
            };
            request.onload =  () => {
              if (request.status >= 199 && request.status < 300) {
                load(request.responseText);
                this.fetchGallery()
              } 
            };
            request.send(formData);
            return {
              abort: () => {
                request.abort();
                abort
              }
            }

          }
       
        } 
      });




  

    }
  }
  }

  createApp({

    $delimiters: ['${', '}'],
    // exposed to all expressions
    file: null,
    payoutTab: true,
    galleryTab: false,
    modelHeader: [],
    excelHeader: [],
    headerData: [],
    images: null,
    uploadExcelButtonVisibility: false,
    retryUploadVisibility: false,
    uploadForm: true,
    overwriteCheckbox: false,
    payoutUploadFormVisibility: true,
    resultVisibility: false,
    uploadStatus: false,
    tab: 1,
    // getters
    filep,
    lightBox,
    

    upload()
    {
      const files = document.querySelector('#monggi');
      this.images = files;
      console.log(this.images)
      // files.map(item => item.file).forEach(file => formData.append('my-file', file))
    },
    resetPayoutUpload() {
      this.uploadExcelButtonVisibility = false
      this.retryUploadVisibility = false
      this.uploadForm = true
      this.payoutUploadFormVisibility = true
    },
    uploadFile() {
      this.file = this.$refs.file.files[0];
      console.log(this.file)
    },
    async submitPrepareExcel() {
      const formData = new FormData();
      formData.append('file', this.file);
      const headers = {
        'Content-Type': 'multipart/form-data'
      };
      await axios.post('/prepare', formData, {
        headers
      }).then((res) => {
        res.data.files; // binary representation of the file
        res.status; // HTTP status
        this.modelHeader = res.data.main_header;
        this.excelHeader = res.data.excel_header;
        this.uploadExcelButtonVisibility = true;
        this.retryUploadVisibility = true;
        this.uploadForm = false

      })
    },
    async submitUploadExcel(form) {
      var obj = []
      console.log(this.modelHeader.length)

      this.modelHeader.forEach((e) => {

        if (form.target.elements[e].value !== '') {
          obj.push({
            [e]: form.target.elements[e].value
          })
        }
      })

      const formData = new FormData();
      formData.append('file', this.file);
      formData.append('event_id', {{ $widget['eventId'] }}  ) 
      formData.append('checkbox_overwrite', this.overwriteCheckbox);
      formData.append('headers', JSON.stringify(obj));

      const headers = {
        'Content-Type': 'multipart/form-data'
      };
      await axios.post('/upload_excel', formData, {
        headers
      }).then((res) => {
        this.uploadStatus = res.data
        this.resultVisibility = true
        this.payoutUploadFormVisibility = false
      })
    },
  }).mount('#adi')
</script>

<style>
  .payout-tab {
    padding-left: unset;
  }

  .tab-content: {
    display:none;
  }

  .card {
    border:none;
  }


  .thumbnail::after {


  background-color: pink;
  z-index: inherit;

  transition: background-color 2s ease-out;
  }

.thumbnail:hover {
  background-color: yellow;
  }


  .container {
 

    min-width: 80px;
    width:auto;
}

.image {
  opacity: 1;
  transition: .5s ease;
  backface-visibility: hidden;
}


.container:hover .image {
  opacity: 0.5;
  background-color: black;
}

.container:hover .middle {
  opacity: 1;
}




</style>

<script>



</script>



