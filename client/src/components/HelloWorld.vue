

<template>
  <div class="large-12 medium-12 small-12 cell">
    <label>File
      <input type="file" id="file" ref="file" @change="handleFileUpload()"/>
    </label>
    <br>
    <progress max="100" :value.prop="uploadPercentage"></progress>
    <br>

    <button class="btn btn-primary" type="button" disabled="" v-if="loading">
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    </button>

    <button class="btn btn-primary rounded-pill px-3"
            @click="submitFile()"
            v-else
            type="button">Submit
    </button>

    {{ uploadPercentage }}
  </div>

</template>

<style scoped>
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  position: relative;
  top: -10px;
}

h3 {
  font-size: 1.2rem;
}

.greetings h1,
.greetings h3 {
  text-align: center;
}

@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>
