<template>
    <div>
        <form v-on:submit.prevent>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div v-if="isActiveTab(1)">
                                <Main
                                    :total_price="total_price"
                                    :data="data"
                                    :subjects="subjects"
                                    :pricingTypes="pricingTypes"
                                    :services="services"
                                    :levels="levels"
                                    :urgencies="urgencies"
                                    :guarantees="guarantees"
                                    :spacings="spacings"
                                    :user_id="user_id"
                                    :errors="errors"
                                    :restricted_order_page_url="
                                        restricted_order_page_url
                                    "
                                    :create_account_url="create_account_url"
                                    :additional_services_by_service_id_url="
                                        additional_services_by_service_id_url
                                    "
                                    :sub_categories_by_service_id="
                                        sub_categories_by_service_id
                                    "
                                    @changeTab="changeTab($event)"
                                    @dataChanged="
                                        handleServiceSelection($event)
                                    "
                                    :dataForOrderSummary="dataForOrderSummary"
                                    @dataChangedd="handleCalculatedData($event)"
                                ></Main>
                                <!-- <div v-if="data.isPriceShow"> -->
                                <Instruction
                                    :total_price="total_price"
                                    :subjects="subjects"
                                    :data="data"
                                    :errors="errors"
                                    :term_and_condition_url="
                                        term_and_condition_url
                                    "
                                    :privacy_policy_url="privacy_policy_url"
                                    :upload_attachment_url="
                                        upload_attachment_url
                                    "
                                    :email_marketing_url="email_marketing_url"
                                    @changeTab="changeTab($event)"
                                    @submitRequest="handleSubmit($event)"
                                    :dataForOrderSummary="dataForOrderSummary"
                                    @dataChangedd="handleCalculatedData($event)"
                                ></Instruction>
                                <!-- </div> -->

                                <OrderSummary
                                    :form="dataForOrderSummary"
                                    @dataChanged="handleCalculatedData($event)"
                                    @totalPrice="handleTotalPrice($event)"
                                ></OrderSummary>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import ServiceSelection from "./home/ServiceSelection.vue";
import Instruction from "./home/Instruction.vue";
import OrderSummary from "./home/OrderSummary.vue";
import Details from "./home/Details.vue";
import Main from "./home/Main.vue";

export default {
    components: {
        ServiceSelection,
        Instruction,
        OrderSummary,
        Details,
        Main
    },
    props: {
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
        upload_attachment_url: {
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
        add_to_cart_url: {
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
        }
    },

    data() {
        return {
            pricingTypes: {
                fixed: 1,
                perWord: 2,
                perPage: 3,
                PerSlide: 4
            },
            activeTab: 1,

            form: {},
            data: {
                service: {},
                guarantee: 1,
                name: "",
                time: new Date()
                    .toTimeString()
                    .replace(/:\d+ /, " ")
                    .split(" ")[0],
                subject: this.subjects ? this.subjects[0] : {},
                isLoading: false,
                files_data: {}
            },
            total_price: 0,
            dataForOrderSummary: {},
            errors: {}
        };
    },
    methods: {
        handleServiceSelection($data) {
            this.dataForOrderSummary = $data;
        },
        handleCalculatedData($calculatedData) {
            this.form = $calculatedData;
        },
        handleTotalPrice($total) {
            this.total_price = $total;
        },
        handleSubmit($data) {
            var mergedRecords = { ...this.form, ...$data, ...this.data };
            this.submitForm(mergedRecords);
        },
        changeTab(tabNumber) {
            // if (tabNumber == 2 && !this.user_id) {
            //     window.location = this.restricted_order_page_url;
            //     return false;
            // }
            this.activeTab = tabNumber;
        },
        isActiveTab: function(tab) {
            return this.activeTab == tab;
        },
        submitForm(formRecords) {
            var scriptTag = document.createElement("script");
            var gtag = document.createTextNode(
                "function gtag_report_conversion(url) {var callback = function () {if (typeof (url) != 'undefined') {window.location = url;}};gtag('event', 'conversion', {'send_to': 'AW-344015901/7AeSCPSrj68DEJ2IhaQB','event_callback': callback});return false;}}"
            );
            scriptTag.appendChild(gtag);
            document.head.appendChild(scriptTag);

            this.data.isLoading = true;
            this.errors = [];
            var $scope = this;
            axios
                .post(this.add_to_cart_url, formRecords)
                .then(function(response) {
                    if (response.data.redirect_url) {
                        window.dataLayer = window.dataLayer || [];
                        window.dataLayer.push({ event: "OrderNowClickCal" });
                        window.location.href = response.data.redirect_url;
                    } else if (response.data.errors) {
                        $scope.data.isLoading = false;
                        $scope.errors = response.data.errors;
                    } else {
                        $scope.data.isLoading = false;
                        // alert("Something went wrong");
                        console.log("Something went wrong");
                    }
                })
                .catch(function(error) {
                    console.log(error);
                    $scope.data.isLoading = false;
                    // alert("Something went wrongs");
                    console.log("Something went wrong");
                });
        }
    }
};
</script>
