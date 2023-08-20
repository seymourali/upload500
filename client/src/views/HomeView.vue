<template>
  <div class="large-12 medium-12 small-12 cell">
    <div class="progress" v-if="loading">
      {{ uploadPercentage }}

      <div class="progress-bar progress-bar-striped progress-bar-animated"
           role="progressbar"
           :aria-valuenow="uploadPercentage"
           aria-valuemin="0"
           aria-valuemax="100"
           :style="{width: uploadPercentage + '%'}">
      </div>
    </div>

    <br>

    <div class="alert alert-success" role="alert" v-if="uploadResult.success">
      <div class="d-flex justify-content-end">
        <button type="button" style="border:none;font-size: 20px;background: transparent;" @click="uploadResult.success = false">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <p class="text-success">Valid rows count: {{ uploadResult.valid }}</p>
      <p class="text-danger">Invalid rows count: {{ uploadResult.invalid }}</p>
    </div>

    <br>

    <div>
      <label for="formFileLg" class="form-label">Upload CSV file</label>
      <input class="form-control form-control-lg"
             id="formFileLg" type="file" ref="file"
             v-on:change="file"
             @change="handleFileUpload()" />
    </div>

    <div style="margin-top: 20px;">
      <button class="btn btn-primary" type="button" disabled="" v-if="loading">
        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
        <span role="status"> Loading...</span>
      </button>
      <button class="btn btn-primary px-3"
              @click="submitFile()"
              v-else
              type="button">Submit
      </button>
    </div>
  </div>
</template>

<script>
import baseHttp from "../api/baseHttp";

export default {
  data() {
    return {
      file: '',
      loading: false,
      uploadPercentage: 0,
      uploadResult: {
        success: false,
        valid: 0,
        invalid: 0
      }
    }
  },

  methods: {
    submitFile() {
      if (!this.file) return;

      /**
       * Initialize the form data
       */
      let formData = new FormData();

      /**
       * Add the form data we need to submit
       */
      formData.append('file', this.file);

      this.loading = true;

      /**
       * Make the request to the POST /single-file URL
       */
      baseHttp.post('/import', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        },
        onUploadProgress: function( progressEvent ) {
          console.log('### progress', progressEvent);
          this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
          //this.uploadPercentage = parseFloat((progressEvent.loaded / progressEvent.total).toFixed(2))
          console.log('### percent', this.uploadPercentage);
        }.bind(this)
      })
      .then((resp)   => {
        this.$toast.success(resp.data.message, {
          position: 'top'
        });
        this.uploadResult.valid   = resp.data.valid_rows_count;
        this.uploadResult.invalid = resp.data.invalid_rows_count;
        this.uploadResult.success = true;
        this.$refs.file.value = '';
      })
      .catch((e) => {
        this.$toast.error(e.response.data.errors.file[0], {
          position: 'top'
        });
      })
      .finally(() => this.loading = false);
    },

    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    }
  }
}
</script>
