
const TheSanPham = {
    props: {
        ten: {
            type: String,
            required: true
        },

        gia: {
            type: Number,
            required: true
        },

        anh: {
            type: String,
            default: "https://placehold.co/300x200?text=No+Image"
        },

        moTa: {
            type: String,
            default: "Chưa có mô tả sản phẩm."
        },

        soLuongTon: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            hienMoTa: false
        };
    },

    methods: {
        toggleMoTa() {
            this.hienMoTa = !this.hienMoTa;
        },

        formatGia(gia) {
            return gia.toLocaleString("vi-VN") + " VNĐ";
        }
    },

    template: `
        <div class="product-card">
            <img :src="anh" :alt="ten">

            <h3>{{ ten }}</h3>

            <p class="price">
                Giá: {{ formatGia(gia) }}
            </p>

            <p>
                Số lượng tồn: {{ soLuongTon }}
            </p>

            <p v-if="soLuongTon > 0" class="in-stock">
                Còn hàng
            </p>

            <p v-else class="out-stock">
                Hết hàng
            </p>

            <button @click="toggleMoTa">
                {{ hienMoTa ? "Ẩn mô tả" : "Xem mô tả" }}
            </button>

            <p v-if="hienMoTa" class="description">
                {{ moTa }}
            </p>

            <button :disabled="soLuongTon <= 0">
                Mua
            </button>
        </div>
    `
};
