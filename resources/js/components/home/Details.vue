<template>
    <div>
        <!-- <h5 class="card-title">
      Step
      <b>2</b>/
      <span class="small">3</span> ADDITIONAL PAPER DETAILS
    </h5> -->
        <div class="md-card-content">
            <div id="" class="wizard clearfix">
                <div class="steps clearfix">
                    <ul role="tablist">
                        <li
                            role="tab"
                            class="current"
                            aria-disabled="false"
                            aria-selected="true"
                        >
                            <a href="#" aria-controls="wizard_advanced-p-0"
                                ><span class="number">1</span>
                                <span class="title">Place Order</span></a
                            >
                        </li>
                        <li
                            role="tab"
                            class=""
                            aria-disabled="false"
                            aria-selected="true"
                        >
                            <a
                                id="wizard_advanced-t-1"
                                href="#"
                                aria-controls="wizard_advanced-p-1"
                                ><span class="number">2</span>
                                <span class="title">Additional Details</span></a
                            >
                        </li>
                        <li role="tab" class="last" aria-disabled="true">
                            <a
                                id="wizard_advanced-t-2"
                                href="#"
                                aria-controls="wizard_advanced-p-2"
                                ><span class="number">3</span>
                                <span class="title">Pay Fee</span></a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group">
            <label>Guarantee</label>
            <div>
                <div
                    class="btn-group btn-group-toggle flex-wrap"
                    data-toggle="buttons"
                >
                    <label
                        class="btn btn-outline-primary"
                        v-on:click="guaranteeChanged(row.id, index)"
                        :class="
                            form.guarantee_id === Number(row.id) ? 'active' : ''
                        "
                        v-for="(row, index) in guarantees"
                        :key="index"
                    >
                        <input
                            type="radio"
                            class="btn-group-toggle"
                            :id="'guarantee_' + index"
                            :value="row.id"
                            autocomplete="off"
                            v-model="form.guarantee_id"
                        />
                        {{ row.name }}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Full Name <span class="required">*</span></label>
            <input type="text" class="form-control" v-model="form.name" />
            <div class="invalid-feedback d-block" v-if="errors.title">
                {{ errors.title[0] }}
            </div>
        </div>
        <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <input type="email" class="form-control" v-model="form.email" />
            <div class="invalid-feedback d-block" v-if="errors.title">
                {{ errors.title[0] }}
            </div>
        </div>
        <div class="form-group">
            <label>Phone No</label>
            <input type="number" class="form-control" v-model="form.phone" />
            <div class="invalid-feedback d-block" v-if="errors.title">
                {{ errors.title[0] }}
            </div>
        </div>
        <div class="form-group">
            <label>Subject <span class="required">*</span></label>
            <input type="text" class="form-control" v-model="form.subject" />
            <div class="invalid-feedback d-block" v-if="errors.title">
                {{ errors.title[0] }}
            </div>
        </div>
        <div>
            <button
                :disabled="hasError"
                type="button"
                class="btn btn-primary btn-lg btn-block"
                v-on:click.prevent="changeTab(2)"
            >
                <i class="fas fa-arrow-circle-right"></i> Next
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
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
        errors: {
            type: Object,
            default() {
                return null;
            }
        },
        guarantees: {
            type: Array,
            default() {
                return {};
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
    data() {
        return {
            hasError: false,
            form: {
                guarantee_model: this.guarantees ? this.guarantees[1] : {},
                guarantee_id: this.guarantees ? this.guarantees[1].id : 1,
                name: "",
                email: "",
                number: "",
                subject: ""
            }
        };
    },

    methods: {
        changeTab(tabNumber) {
            this.$emit("changeTab", tabNumber);
        },
        guaranteeChanged(guarantee_id, index) {
            this.form.guarantee_model = this.guarantees[index];
            this.form.guarantee_id = guarantee_id;
        }
    }
};
</script>
