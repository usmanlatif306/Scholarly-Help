<template>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 p-0">
                        <img
                            src="https://www.clipartmax.com/png/middle/171-1717870_stockvader-predicted-cron-for-may-user-profile-icon-png.png"
                            alt="Writer-Image"
                            class="writer-profile-image"
                        />
                        <a
                            href=""
                            class="text-muted writer-profile-link d-block mt-1"
                            >View Profile</a
                        >
                    </div>
                    <div class="col-8 p-0">
                        <a href="" class="writer-name">
                            {{ writer.first_name }} {{ writer.last_name }}
                        </a>
                        <small class="writer-order-history d-block"
                            >14 completed order</small
                        >
                        <div
                            class="writer-rating d-flex justify-content-between"
                        >
                            <div class="">
                                <span>100%</span>
                                <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                            </div>

                            <span class="writer-bid-price"
                                >${{ order.total }}</span
                            >
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button
                                class="btn btn-sm btn-primary ml-5"
                                @click="$emit('open-chat-writer', writer)"
                            >
                                Chat
                            </button>
                            <button
                                type="submit"
                                class="btn btn-sm btn-warning mr-2 px-3"
                            >
                                Hire
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["writer", "order"]
};
</script>

<style></style>
