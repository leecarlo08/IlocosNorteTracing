<template>
    <div class="row">
        <div class="col-md-12">
            <h3>Create New Tourist Spot</h3>
            <hr>
            <form @submit.prevent="save">
                <div class="form-group">
                    <label for="title">Tourist Spot</label>
                    <input type="text" class="form-control" id="title" v-model="article.name" placeholder="Enter Title" required>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label">Description</label>
                    <div class="col-md-12">

                        <froala
                            :tag="'textarea'"
                            :config="config"
                            v-model="article.description"></froala>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5> Images </h5>
                    <hr>
                    <div class="large-12 medium-12 small-12 filezone">
                        <input type="file" id="files" ref="docs" multiple @change="handleFiles()"/>
                        <p>
                            Drop your files here <br>or click to search
                        </p>
                    </div>

                    <div class="row">
                        <div align="center" class="col-md-3" v-for="(file, key) in docs" style="margin-top: 15px" v-if="file.id == null">
                            <img class="prev-img" v-bind:ref="'preview'+parseInt(key)"/>
                            <div style="overflow-wrap: break-word"><small>{{ file.name }}</small></div>
                            <div style="position: absolute; right: 35px; top: 10px">
                                <a class="remove" @click="removeFile(key)">X</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div align="center" class="form-group">
                    <router-link to="." class="btn btn-default">Back</router-link>
                    <button class="btn btn-secondary" type="submit">Next</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                article:{
                    name: null,
                    description: null
                },
                article_id: null,
                docs: [],

                config: {
                    events: {
                        initialized: function () {
                            console.log('initialized')
                        },
                        'image.removed': function ($img) {
                            window.axios.post(`/super-user/delete/image`, {imageSrc: $img[0].src})
                                .then(({data}) => {
                                    if(data){
                                        console.log('Deleted');
                                    }else{
                                        console.log('Failed');
                                    }
                                });
                            console.log($img,$img[0].src);
                        }
                    },
                    imageUploadURL: '/super-user/article/upload',
                    attribution: false,
                    quickInsertEnabled: false,
                    toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting',
                        'alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'formatOLSimple', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote',
                        'insertLink', 'insertImage', 'insertTable', 'emoticons', 'specialCharacters', 'embedly', 'insertHR',
                        'undo', 'redo', 'fullscreen', 'selectAll', 'html', 'help'],
                    lineHeights: {
                        '0.5': '0.5',
                        '1': '1',
                        '1.15': '1.15',
                        '1.5': '1.5',
                        Double: '2'
                    },
                    tabSpaces: 4,
                    imageAddNewLine: true,
                    zIndex: 2501,
                    width: '788.28',
                    imageStyles: {
                        class1: 'Border',
                        class2: 'Opacity 0.5',
                        class3: 'Rounded'
                    },
                    tableStyles: {
                        class1: 'Stripe',
                        class2: 'Border None',
                    }
                },
            }
        },
        methods: {

            onReady( editor )  {
                // Insert the toolbar before the editable area.
                editor.ui.getEditableElement().parentElement.insertBefore(
                    editor.ui.view.toolbar.element,
                    editor.ui.getEditableElement(),
                );
            },

            handleFiles() {
                let uploadedFiles = this.$refs.docs.files;

                for(var i = 0; i < uploadedFiles.length; i++) {
                    this.docs.push(uploadedFiles[i]);
                }
                this.getImagePreviews();
            },
            getImagePreviews(){
                this.article.thumbnail = this.docs.length;
                for( let i = 0; i < this.docs.length; i++ ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.docs[i].name ) ) {
                        let reader = new FileReader();
                        reader.addEventListener("load", function(){
                            this.$refs['preview'+parseInt(i)][0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL( this.docs[i] );
                    }else{
                        this.$nextTick(function(){
                            this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
                        });
                    }
                }
            },
            removeFile( key ){
                this.docs.splice( key, 1 );
                this.getImagePreviews();
            },
            submitFiles(val){
                for(let i=0; i<this.docs.length; i++){
                    if(this.docs[i].id) {
                        continue;
                    }
                    let formData = new FormData();
                    formData.append('docs', this.docs[i]);

                    window.axios.post('/super-user/save-image/'+val,
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(({data}) => {
                        this.docs[i].id = data.id;
                        this.docs.splice(i, 1, this.docs[i]);
                    }).catch(function(data) {
                        console.log('error');
                    });
                    if(i >= this.docs.length - 1){
                        this.$router.push({path: `/super-user/spot/${this.article_id}/edit`})
                    }
                }


            },
            save() {
                window.axios.post('/super-user/spot/create' , this.article).then(({data}) => {
                    this.article_id = data[1];
                    if(data[0]){
                        this.submitFiles(data[0])
                    } else {
                        this.$router.push({path: `/super-user/spot/${this.article_id}/edit`})
                    }
                })

            },

        }
    }
</script>

<style scoped>
    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        position: relative;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }

    a.remove{
        color: red;
        cursor: pointer;
        font-weight: 700;
        background-color: #e1e1e1;
        padding: 2px 5px;
        border:none;
    }

    .prev-img{
        max-width: 75%;
        max-height: 75px;
    }

    .my-editor {
        height: 600px;
    }
</style>
