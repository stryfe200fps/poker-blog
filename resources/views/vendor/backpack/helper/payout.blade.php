
<script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>

  <a href="#upload-pane" class="btn btn-primary" id="editing"> Upload via excel </a>

  <script>
    $(document).ready(function () {
      const customButton = document.querySelector('#editing');
      const uploadPane = document.querySelector('#upload-pane');
      const backpackWrapper = document.querySelector('.with-border');
      const tableWrapper = document.querySelector('#crudTable_wrapper');
      // backpackWrapper.parentElement.classList.add('col-md-12')
      // let miniVar = backpackWrapper.innerHTML;
      // tableWrapper.prepend(uploadPane)
      backpackWrapper.append(customButton);
      // uploadPane.classList.add('d-none');
    })
    </script>

    <br>

<h2> Upload data via excel</h2>

<div   id="upload-pane" class="mt-3">
  <div class="card">
  <div class="card-body">
  <div  id="app">

      <div  v-cloak  data-select2-id="18">
            <div v-if="payoutUploadFormVisibility" class="  " element="div" bp-field-wrapper="true" bp-field-name="players" bp-field-type="repeatable" data-select2-id="17">
              <div v-if="uploadForm">
                <form method="post" enctype="multipart/form-data" action="excel">
                  @if (count($main_header ?? []))
                  @foreach ($main_header as $heading)
                  {{$heading }}
                  <select>
                    <option value=""> no value </option>
                    @if (isset($header) )
                    @foreach ($header ?? [] as $head)
                    <option value="{{ $head }}"> {{ $head }} </option>
                    @endforeach
                    @endif
                  </select>
                  <br>
                  @endforeach
                  @endif
                  @csrf
                  <input  accept=".xlsx" type="file" @change="uploadFile" ref="file">
                  <br>
                  <br>
                  <input @click.prevent="submitPrepareExcel" value="Prepare Excel" class="btn btn-primary" type="submit">
                </form>
              </div>
         
              <div class="">
                <form @submit.prevent="submitUploadExcel" ref="form" v-if="modelHeader" id="bestForm">
                  <div class="row 1">
                    <template  v-for="(header, index ) in modelHeader" :key="index">
                      <select @include('crud::fields.inc.attributes', ['default_class'=> 'form-control select2_from_array col-md-6  ml-2'])
                        :name="header">
                        <option value=""> </option>
                        <option v-for="(header, index ) in excelHeader" :key="index">
                          ${ header }
                        </option>
                      </select>
                      <div class="ml-2 mt-1"> ${ header } </div>
                      <br><br>
                    </template>
                  </div>
                  <label v-if="uploadExcelButtonVisibility" style="display:block" class="ml-2 mt-1">
                    <input type="checkbox" v-model="overwriteCheckbox" value="overwrite" />
                    Overwrite data?
                  </label>
                  <div >
                    <input v-if="uploadExcelButtonVisibility" class="btn btn-success" type="submit" value="upload excel" />
                    <a href="#" @click.prevent="resetPayoutUpload" v-if="retryUploadVisibility" >retry</a>
                  </div>
                </form>
              </div>
            </div>
            <div  v-else>

              <div >

                <div v-if="uploadStatus">
                  <div class=" alert alert-success">
                    <span style="color:white;">Upload successfully! </span>
                  </div>
                </div>
                <div v-else class="alert alert-error">Upload failed. Please check your excel</div>
                      <a href="#" @click.prevent="resetPayoutUpload" v-if="retryUploadVisibility" >retry</a>
              </div>
            </div>
          </div>


  </div>



  </div>
  </div>
</div>


<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="module">

  import {
    createApp
  } from 'https://unpkg.com/petite-vue?module'



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
    // getters

    upload()
    {
      const files = document.querySelector('#monggi');
      this.images = files;
      console.log(this.images)
      // files.map(item => item.file).forEach(file => formData.append('my-file', file))
    },
    resetPayoutUpload() {

      this.modelHeader = false
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
      if ( typeof(this.file) === 'undefined')
      {
        return;
      }
      const formData = new FormData();
      formData.append('file', this.file);
      const headers = {
        'Content-Type': 'multipart/form-data'
      };
      await axios.post('/prepare', formData, {
        headers
      }).then((res) => {

        console.log(res.data);
        if (res.data === 0) {

          alert('please upload in excel format only')
          return;
        }

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
  }).mount('#app')

</script>


<style>


.with-border{
  margin-bottom:6px!important;
}

#datatable_info_stack {
  display:none!important;
}
</style>