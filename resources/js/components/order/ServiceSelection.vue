<template>
    <div>
        <!-- <h5 class="card-title">
      Step
      <b>1</b>/
      <span class="small">3</span> TYPE OF WORK AND DEADLINE
    </h5> -->
        <div class="md-card-content">
            <div id="" class="wizard clearfix">
                <div class="steps clearfix">
                    <ul role="tablist">
                        <li
                            role="tab"
                            class="first current"
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
                                <span class="title">Choose Tutor</span></a
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
        <div class="form-row">
            <div class="form-group col-12">
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
                                form.guarantee_id === Number(row.id)
                                    ? 'active'
                                    : ''
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
            <div class="form-group col-12">
                <label>Work Level</label>
                <div>
                    <div
                        class="btn-group btn-group-toggle flex-wrap"
                        data-toggle="buttons"
                    >
                        <label
                            class="btn btn-outline-primary"
                            v-on:click="workLevelChanged(row.id, index)"
                            :class="
                                form.work_level_id === Number(row.id)
                                    ? 'active'
                                    : ''
                            "
                            v-for="(row, index) in levels"
                            :key="index"
                        >
                            <input
                                type="radio"
                                class="btn-group-toggle"
                                :id="'workLevel_' + index"
                                :value="row.id"
                                autocomplete="off"
                                v-model="form.work_level_id"
                            />
                            {{ row.name }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div
                class="form-group"
                :class="
                    form.service_model.price_type_id == pricingTypes.perPage ||
                    form.service_model.price_type_id == pricingTypes.perWord ||
                    form.service_model.price_type_id == pricingTypes.PerSlide
                        ? 'col-6'
                        : 'col-12'
                "
            >
                <label>Service Type</label>
                <multiselect
                    track-by="name"
                    label="name"
                    v-model="form.service_model"
                    :options="services"
                    group-label="category"
                    group-values="subcategory"
                    :group-select="false"
                    :show-labels="false"
                    @input="getAdditionalServices(form.service_model)"
                ></multiselect>
            </div>
            <!-- if service has number of slide option -->
            <div
                class="form-group col-6"
                v-if="form.service_model.price_type_id == pricingTypes.PerSlide"
            >
                <label class="">Number of slides</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button
                            type="button"
                            class="btn btn-sm btn-outline-secondary"
                            v-on:click="changeSlideNumber(-1)"
                        >
                            -
                        </button>
                    </div>
                    <input
                        type="number"
                        class="form-control form-control-sm text-center"
                        aria-describedby="basic-addon1"
                        v-model="form.number_of_slides"
                        v-on:keypress="isNumber($event)"
                        @change="validateNumberOfPages"
                    />
                    <div class="input-group-append">
                        <div class="input-group-prepend">
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                v-on:click="changeSlideNumber(1)"
                            >
                                +
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="invalid-feedback d-block"
                    v-if="errors.number_of_slides"
                >
                    {{ errors.number_of_slides[0] }}
                </div>
            </div>
            <!-- if service has number of per page -->
            <div
                class="form-group col-6"
                v-if="form.service_model.price_type_id == pricingTypes.perPage"
            >
                <label>Pages <small>(275 words/page)</small></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button
                            type="button"
                            class="btn btn-sm btn-outline-secondary"
                            v-on:click="changePageNumber(-1)"
                        >
                            -
                        </button>
                    </div>
                    <input
                        type="number"
                        class="form-control form-control-sm text-center"
                        aria-describedby="basic-addon1"
                        v-model="form.number_of_pages"
                        v-on:keypress="isNumber($event)"
                        @change="validateNumberOfPages"
                    />
                    <div class="input-group-append">
                        <div class="input-group-prepend">
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                v-on:click="changePageNumber(1)"
                            >
                                +
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="invalid-feedback d-block"
                    v-if="errors.number_of_pages"
                >
                    {{ errors.number_of_pages[0] }}
                </div>
            </div>

            <!-- if service has number of per word -->
            <div
                class="form-group col-6"
                v-if="form.service_model.price_type_id == pricingTypes.perWord"
            >
                <label>Quantity</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button
                            type="button"
                            class="btn btn-sm btn-outline-secondary"
                            v-on:click="changeNumberOfWords(-1)"
                        >
                            -
                        </button>
                    </div>
                    <input
                        type="number"
                        class="form-control form-control-sm text-center"
                        aria-describedby="basic-addon1"
                        v-model="form.number_of_words"
                        v-on:keypress="isNumber($event)"
                        @change="validateNumberOfWords"
                    />
                    <div class="input-group-append">
                        <div class="input-group-prepend">
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                v-on:click="changeNumberOfWords(1)"
                            >
                                +
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="invalid-feedback d-block"
                    v-if="errors.number_of_words"
                >
                    {{ errors.number_of_words[0] }}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <div class="form-group">
                    <label class="">Deadline (EST)</label>
                    <div class="d-flex custom-border rounded">
                        <Datepicker
                            v-model="customDate"
                            format="dd-MM-yyyy"
                            class="date-picker"
                            :disabled-dates="disabledDates"
                        ></Datepicker>
                        <input
                            type="time"
                            class="time-picker border-0"
                            v-model="data.time"
                        />
                    </div>
                </div>
            </div>
            <div class="form-group col-6">
                <div class="form-group">
                    <label class="">Subject</label>
                    <multiselect
                        track-by="id"
                        label="name"
                        v-model="data.subject"
                        :options="subjects"
                        :show-labels="false"
                    ></multiselect>
                    <div class="invalid-feedback d-block" v-if="errors.subject">
                        {{ errors.subject[0] }}
                    </div>
                </div>
            </div>
        </div>

        <div v-if="additional_services.length > 0">
            <h5>Additional Services</h5>
            <div
                class="card mb-3"
                v-for="row in additional_services"
                v-bind:key="row.id"
            >
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ row.name }}</h5>
                            <p class="card-text">{{ row.description }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="d-flex justify-content-center"
                            style="margin-top: 40px;"
                        >
                            <a
                                href="#"
                                v-on:click.prevent="
                                    additionalServiceChanged(row.id, row)
                                "
                            >
                                <div
                                    class="btn btn-block"
                                    v-bind:class="
                                        getServiceContainerClass(row.id)
                                    "
                                >
                                    <span v-if="addedServiceList(row.id)">
                                        <i class="fas fa-check-circle"></i>
                                        Added
                                    </span>
                                    <span v-else>
                                        <i class="fas fa-plus"></i> Add
                                    </span>
                                    {{ row.rate | formatMoney }}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import Datepicker from "vuejs-datepicker";

export default {
    components: {
        Multiselect,
        Datepicker
    },
    props: {
        pricingTypes: {
            default: {}
        },
        data: {
            type: Object,
            default() {
                return {};
            }
        },
        services: {
            default: {}
        },
        subjects: {
            default: {}
        },
        levels: {
            type: Array,
            default() {
                return {};
            }
        },
        urgencies: {
            type: Array,
            default() {
                return {};
            }
        },
        guarantees: {
            type: Array,
            default() {
                return {};
            }
        },
        spacings: {
            type: Array,
            default() {
                return {};
            }
        },
        user_id: {
            type: [Boolean, Number],
            default() {
                return null;
            }
        },
        restricted_order_page_url: {
            type: String,
            default() {
                return null;
            }
        },
        additional_services_by_service_id_url: {
            type: String,
            default() {
                return null;
            }
        },
        sub_categories_by_service_id: {
            type: String,
            default() {
                return null;
            }
        },
        create_account_url: {
            type: String,
            default() {
                return null;
            }
        }
    },

    filters: {
        formatMoney: function(value) {
            return accounting.formatMoney(value, currencyConfig.currency);
        }
    },
    created() {
        this.triggerChange(this.form);
        this.getAdditionalServices(this.form.service_model);
    },
    watch: {
        form: {
            handler(val) {
                this.triggerChange(val);
            },
            deep: true
        },
        customDate: {
            handler(val) {
                this.handleDate();
            },
            deep: true
        },
        data: {
            handler(val) {
                this.handleDate();
            },
            deep: true
        },
        errors: {
            handler(val) {
                this.checkError(val);
            },
            deep: true
        }
    },

    data() {
        return {
            customDate: new Date(
                this.urgencies[0].date.toLocaleString().split(",")[0]
            ),
            // new Date().getFullYear(),new Date().getMonth(),new Date().getDate() + 7
            disabledDates: {
                to: new Date(this.beforeDates())
                // from: new Date(this.afterDates())
            },
            hasError: false,
            errors: {},
            isDisable: false,
            additional_services: [],
            sub_categories: this.services ? this.services[0] : {},
            form: {
                customDate: new Date(),
                service_model: this.services
                    ? this.services[0].subcategory[0]
                    : {},
                sub_category: null,
                urgency_model: this.urgencies ? this.urgencies[0] : {},
                work_level_model: this.levels ? this.levels[0] : {},
                work_level_id: this.levels ? this.levels[0].id : 1,
                guarantee_model: this.guarantees ? this.guarantees[2] : {},
                guarantee_id: this.guarantees ? this.guarantees[2].id : 1,
                number_of_words: this.services[0].subcategory[0]
                    .minimum_order_quantity,
                number_of_pages: this.services[0].subcategory[0]
                    .minimum_order_quantity,
                number_of_slides: this.services[0].subcategory[0]
                    .minimum_order_quantity,
                spacing_type: "double",
                added_services: []
            }
        };
    },
    methods: {
        handleDate() {
            // filtering service which has type "hours"
            let hourServices = this.urgencies.filter(
                item => item.type === "hours"
            );
            let greaterHour = 0;
            for (let i = 0; i < hourServices.length; i++) {
                let val = parseInt(hourServices[i].name.split(" ")[0]);
                if (greaterHour < val) {
                    greaterHour = val;
                }
            }
            let currentDateTime = new Date(
                new Date(this.customDate).toLocaleString().split(",")[0] +
                    " " +
                    this.data.time
            );

            let id = 0;
            // if selected date is less than with greaterhour date and time
            if (
                currentDateTime.getTime() <=
                new Date().setHours(new Date().getHours() + greaterHour)
            ) {
                for (let i = 0; i < hourServices.length; i++) {
                    let val = parseInt(hourServices[i].name.split(" ")[0]);
                    let timeCheck = new Date().setHours(
                        new Date().getHours() + val
                    );
                    if (currentDateTime.getTime() < timeCheck) {
                        id = hourServices[i].id;
                    }
                }

                this.form.urgency_model = this.urgencies.find(
                    item => item.id === id
                );
                // console.log("hours: ", this.form.urgency_model);
            } else {
                let daysServices = this.urgencies.filter(
                    item => item.type === "days"
                );
                let greaterDay = 0;
                let greaterDayServiceId = 0;
                for (let i = 0; i < daysServices.length; i++) {
                    let val = parseInt(daysServices[i].name.split(" ")[0]);
                    if (greaterDay < val) {
                        greaterDay = val;
                        greaterDayServiceId = daysServices[i].id;
                    }
                }

                // if service selection on date basic
                let datePicker = new Date(this.customDate)
                    .toLocaleString()
                    .split(",")[0];

                if (
                    new Date(datePicker).getTime() >
                    new Date().setDate(new Date().getDate() + greaterDay)
                ) {
                    // if date pick is greater then our greater day value then apply urgency model as our greater day urgency
                    this.form.urgency_model = this.urgencies.find(
                        item => item.id === greaterDayServiceId
                    );
                } else {
                    // if date pick is less then our greater day value then apply urgency model respective day urgency
                    let index = this.urgencies.findIndex(
                        item =>
                            item.type === "days" &&
                            new Date(
                                item.date.split("-").join("/")
                            ).getTime() === new Date(datePicker).getTime()
                    );
                    this.form.urgency_model = this.urgencies[index];
                }

                // console.log("days: ", this.form.urgency_model);
            }
        },
        beforeDates() {
            let datePicker = new Date().toLocaleString().split(",")[0];
            let date = datePicker.split("/");
            let newDate = date[2] + "," + date[0] + "," + parseInt(date[1]);
            return newDate;
        },
        afterDates() {
            let dates = [];
            for (let index = 0; index < this.urgencies.length; index++) {
                dates.push(
                    new Date(this.urgencies[index].date.split("-").join("/"))
                );
            }
            var maxDate = new Date(Math.max.apply(null, dates));
            let lastDate = new Date(maxDate).toLocaleString().split(",")[0];
            let newValue = lastDate.split("/");
            let newLastdate =
                newValue[2] +
                "," +
                newValue[0] +
                "," +
                (parseInt(newValue[1]) + 1);
            return newLastdate;
        },
        checkError() {
            var errorList = JSON.parse(JSON.stringify(this.errors));
            this.hasError = Object.keys(errorList).length > 0 ? true : false;
        },
        triggerChange(form) {
            this.$emit("dataChanged", form);
        },
        formatMoneyFromNumber($amount) {
            return accounting.formatMoney($amount, currencyConfig.currency);
        },
        workLevelChanged(work_level_id, index) {
            this.form.work_level_model = this.levels[index];

            this.form.work_level_id = work_level_id;
        },
        guaranteeChanged(guarantee_id, index) {
            this.form.guarantee_model = this.guarantees[index];
            this.form.guarantee_id = guarantee_id;
        },
        spacingTypeChanged(type) {
            this.form.spacing_type = type;
        },

        changePageNumber(changeByValue) {
            var changeByValue = parseInt(changeByValue);
            var number_of_pages = parseInt(this.form.number_of_pages);
            if (number_of_pages == 0 && changeByValue < 1) {
                return false;
            }
            if (!Number.isInteger(changeByValue)) {
                return false;
            }
            this.form.number_of_pages = number_of_pages + changeByValue;
            this.validateNumberOfPages();
        },
        changeSlideNumber(changeByValue) {
            var changeByValue = parseInt(changeByValue);
            var number_of_slides = parseInt(this.form.number_of_slides);
            if (number_of_slides == 0 && changeByValue < 1) {
                return false;
            }
            if (!Number.isInteger(changeByValue)) {
                return false;
            }
            this.form.number_of_slides = number_of_slides + changeByValue;
            this.validateNumberOfSlides();
        },
        changeNumberOfWords(changeByValue) {
            var changeByValue = parseInt(changeByValue);
            var number_of_words = parseInt(this.form.number_of_words);

            if (number_of_words == 0 && changeByValue < 1) {
                return false;
            }
            this.form.number_of_words = number_of_words + changeByValue;
            this.validateNumberOfWords();
        },
        validateNumberOfWords() {
            if (
                this.form.number_of_words <
                this.form.service_model.minimum_order_quantity
            ) {
                var minimum_order_quantity = this.form.service_model
                    .minimum_order_quantity;
                this.$set(this.errors, "number_of_words", [
                    "Minium order quantity is " + minimum_order_quantity
                ]);
            } else {
                this.$delete(this.errors, "number_of_words");
            }
            this.$delete(this.errors, "number_of_pages");
        },
        validateNumberOfPages() {
            if (
                this.form.number_of_pages <
                this.form.service_model.minimum_order_quantity
            ) {
                var minimum_order_quantity = this.form.service_model
                    .minimum_order_quantity;
                this.$set(this.errors, "number_of_pages", [
                    "Minium order quantity is " + minimum_order_quantity
                ]);
            } else {
                this.$delete(this.errors, "number_of_pages");
            }
            this.$delete(this.errors, "number_of_words");
        },
        validateNumberOfSlides() {
            if (
                this.form.number_of_slides <
                this.form.service_model.minimum_order_quantity
            ) {
                var minimum_order_quantity = this.form.service_model
                    .minimum_order_quantity;
                this.$set(this.errors, "number_of_slides", [
                    "Minium order quantity is " + minimum_order_quantity
                ]);
            } else {
                this.$delete(this.errors, "number_of_slides");
            }
            this.$delete(this.errors, "number_of_pages");
        },
        getAdditionalServices(service_model) {
            var service_id;
            // checking if category is parent then get additional service for id and if child then for parent service id
            if (parseInt(service_model.parent) === 1) {
                service_id = service_model.id;
            } else {
                service_id = service_model.service_id;
                // if service is child then set sub_category as service
                this.form.sub_category = service_model;
            }

            // Clear the errors
            this.errors = {};
            // Clear the added services
            this.$set(this.form, "added_services", []);

            // var service_id = service_model.id;
            var minimum_order_quantity = service_model.minimum_order_quantity;

            if (service_model.price_type_id == this.pricingTypes.perPage) {
                this.form.number_of_pages = minimum_order_quantity;
            } else {
                this.form.number_of_pages = 1;
            }

            if (service_model.minimum_order_quantity) {
                this.form.number_of_words = minimum_order_quantity;
            } else {
                this.form.number_of_words = 500;
            }

            var $scope = this;
            axios
                .post(this.additional_services_by_service_id_url, {
                    service_id: service_id
                })
                .then(function(response) {
                    $scope.additional_services = response.data;
                })
                .catch(function(error) {
                    // alert("Something went wrongs");
                    console.log("Something went wrong");
                });
        },

        changeTab(tabNumber) {
            this.$emit("changeTab", tabNumber);
        },
        additionalServiceChanged(id, additionalService) {
            var isAlreadyInList = this.addedServiceList(id);

            if (isAlreadyInList) {
                this.form.added_services.splice(isAlreadyInList.key, 1);
            } else {
                this.form.added_services.push(additionalService);
            }
        },
        addedServiceList(id) {
            var status = false;

            $.each(this.form.added_services, function(key, row) {
                if (row.id == id) {
                    return (status = { key: key });
                }
            });

            return status;
        },
        getServiceContainerClass(additionalServiceId) {
            return {
                "btn-orange": this.addedServiceList(additionalServiceId),
                "btn-outline-orange": !this.addedServiceList(
                    additionalServiceId
                )
            };
        },
        isNumber: function(evt) {
            evt = evt ? evt : window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                evt.preventDefault();
            } else {
                return true;
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~vue-multiselect/dist/vue-multiselect.min.css";

html {
    scroll-behavior: smooth;
}

@media (prefers-reduced-motion: reduce) {
    html {
        scroll-behavior: auto;
    }
}

input[type="number"] {
    -moz-appearance: textfield;
}
</style>
