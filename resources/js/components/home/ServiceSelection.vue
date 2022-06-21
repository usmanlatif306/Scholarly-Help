<template>
    <div>
        <div class="form-group">
            <label>Work Level</label>
            <div>
                <div
                    class="btn-group btn-group-toggle flex-wrap"
                    data-toggle="buttons"
                >
                    <label
                        class="btn btn-sm btn-outline-primary"
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

        <div class="form-row">
            <div class="form-group col-12">
                <label>Urgency</label>
                <!-- <multiselect
                    track-by="id"
                    label="name"
                    v-model="form.urgency_model"
                    :options="urgencies"
                ></multiselect> -->
                <Datepicker
                    v-model="customDate"
                    format="dd-MM-yyyy"
                    class="date-picker"
                    :disabled-dates="disabledDates"
                ></Datepicker>
            </div>
            <!-- <div class="form-group">
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
            </div> -->
        </div>

        <!-- <div v-if="additional_services.length > 0">
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
        </div> -->

        <!-- <div v-if="user_id">
            <button
                :disabled="hasError"
                type="button"
                class="btn btn-primary btn-lg btn-block"
                v-on:click.prevent="changeTab(2)"
            >
                <i class="fas fa-arrow-circle-right"></i> Next
            </button>
        </div>
        <div v-else>
            <button
                type="button"
                class="btn btn-success btn-lg btn-block"
                v-on:click.prevent="changeTab(2)"
            >
                <i class="fas fa-sign-in-alt"></i> Sign in to place your order
            </button>

            <a
                :href="create_account_url"
                class="btn btn btn-info btn-lg btn-block"
            >
                <i class="fas fa-user-plus"></i> Create account
            </a>
        </div> -->
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
        data: {
            type: Object,
            default() {
                return {};
            }
        },
        pricingTypes: {
            default: {}
        },
        services: {
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
                to: new Date(this.beforeDates()),
                from: new Date(this.afterDates())
            },
            hasError: false,
            errors: {},
            additional_services: [],
            form: {
                customDate: new Date(),
                service_model: this.data.service,
                subCategory: this.services ? this.services[0] : {},
                sub_category: null,
                urgency_model: this.urgencies ? this.urgencies[0] : {},
                work_level_model: this.levels ? this.levels[0] : {},
                work_level_id: this.levels ? this.levels[0].id : 1,
                guarantee_model: this.guarantees
                    ? this.guarantees[this.data.guarantee]
                    : {},
                guarantee_id: this.guarantees
                    ? this.guarantees[this.data.guarantee].id
                    : 1,
                number_of_words: this.services[0].minimum_order_quantity,
                number_of_pages: this.services[0].minimum_order_quantity,
                spacing_type: "double",
                added_services: []
            }
        };
    },
    methods: {
        handleDate() {
            let datePicker = new Date(this.customDate)
                .toLocaleString()
                .split(",")[0];
            let index = this.urgencies.findIndex(
                item =>
                    new Date(item.date.split("-").join("/")).getTime() ===
                    new Date(datePicker).getTime()
            );
            this.form.urgency_model = this.urgencies[index];
        },
        beforeDates() {
            let datePicker = new Date().toLocaleString().split(",")[0];
            let date = datePicker.split("/");
            let newDate =
                date[2] + "," + date[0] + "," + (parseInt(date[1]) + 1);

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
        getAdditionalServices(service_model) {
            this.form.sub_category = null;
            this.form.subCategory = [];
            if (parseInt(service_model.parent) !== 0) {
                var selectService = this.services.filter(
                    item => item.id === parseInt(service_model.parent)
                );
                this.form.subCategory = selectService;
                this.form.sub_category = selectService[0];
            }

            // Clear the errors
            this.errors = {};
            // Clear the added services
            this.$set(this.form, "added_services", []);

            var service_id = service_model.id;
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
