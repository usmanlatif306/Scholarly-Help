<template>
    <div>
        <div class="form-group mb-0">
            <div class="border custom-border rounded">
                <textarea
                    class="form-control form-control-sm border-0 shadow-none custom-textarea"
                    v-model="form.instruction"
                    placeholder="Specific Instructions e.g., preferred paper structure, outline, grading scale, or any particular work focus."
                ></textarea>
                <div class="form-group px-2 mb-0">
                    <span class="attach-file">
                        <i class="fas fa-paperclip"></i>
                        <label
                            for="attachFile"
                            class="mb-0 cursor-pointer font-sm"
                            >Add File</label
                        >
                    </span>

                    <span style="font-size:14px;">{{ file.name }}</span>
                    <input
                        type="file"
                        ref="file"
                        v-on:change="handleFileUpload()"
                        class="d-none"
                        id="attachFile"
                    />
                </div>
            </div>
            <div class="invalid-feedback d-block" v-if="errors.instruction">
                {{ errors.instruction[0] }}
            </div>
        </div>

        <h4 class="text-right mt-2">
            {{ total_price }}
            <i class="fas fa-fire text-danger"></i>
        </h4>

        <button
            :disabled="data.isLoading"
            class="btn btn-sm btn-primary btn-lg btn-block shadow-none mt-1"
            v-on:click.prevent="submit()"
        >
            <i class="far fa-check-circle"></i> Order now
        </button>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import OrderSummary from "./OrderSummary.vue";
export default {
    components: {
        Multiselect,
        OrderSummary
    },
    props: {
        total_price: {
            default() {
                return null;
            }
        },
        data: {
            type: Object,
            default() {
                return {};
            }
        },
        dataForOrderSummary: {
            default() {
                return null;
            }
        },
        subjects: {
            type: Array,
            default() {
                return {};
            }
        },
        upload_attachment_url: {
            type: String,
            default() {
                return null;
            }
        },
        term_and_condition_url: {
            type: String,
            default() {
                return null;
            }
        },
        privacy_policy_url: {
            type: String,
            default() {
                return null;
            }
        },
        email_marketing_url: {
            type: String,
            default() {
                return null;
            }
        },
        errors: {
            type: Array,
            default() {
                return null;
            }
        }
    },
    computed: {
        classObject: function() {
            return {
                "text-danger": this.error && this.error.type === "fatal"
            };
        }
    },
    computed: {
        isShow() {
            return this.isPriceShow;
        }
    },
    data() {
        return {
            agreedToTermsChecked: false,
            form: {
                subject: "",
                title: "Test",
                instruction: ""
                // files_data: []
            },
            uploadUrl: this.upload_attachment_url,
            uploadHeaders: {
                "X-Test-Header": "vue-file-agent",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content
            },
            filesDataForUpload: [],
            file: ""
        };
    },

    methods: {
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
            let formData = new FormData();
            formData.append("file", this.file);

            axios
                .post(this.uploadUrl, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(({ data }) => {
                    this.data.files_data = data;
                })
                .catch(function(error) {
                    console.log(error);
                    alert("Something went wrongs");
                });
        },
        changeTab(tabNumber) {
            this.$emit("changeTab", tabNumber);
        },
        submit() {
            this.$emit("submitRequest", this.form);
        },
        uploadFiles: function() {
            // Using the default uploader. You may use another uploader instead.
            this.$refs.vueFileAgent.upload(
                this.uploadUrl,
                this.uploadHeaders,
                this.filesDataForUpload
            );
            this.filesDataForUpload = [];
        },
        deleteUploadedFile: function(fileData) {
            // Using the default uploader. You may use another uploader instead.
            this.$refs.vueFileAgent.deleteUpload(
                this.uploadUrl,
                this.uploadHeaders,
                fileData
            );
        },
        filesSelected: function(filesDataNewlySelected) {
            var validFilesData = filesDataNewlySelected.filter(
                fileData => !fileData.error
            );
            this.filesDataForUpload = this.filesDataForUpload.concat(
                validFilesData
            );
            this.uploadFiles();
        },
        fileDeleted: function(fileData) {
            var i = this.filesDataForUpload.indexOf(fileData);
            if (i !== -1) {
                this.filesDataForUpload.splice(i, 1);
            } else {
                this.deleteUploadedFile(fileData);
            }
        }
    }
};
</script>
