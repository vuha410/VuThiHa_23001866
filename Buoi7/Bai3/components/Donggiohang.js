
const DongGioHang = {
    props: {
        item: {
            type: Object,
            required: true
        }
    },

    emits: ["doi-so-luong", "yeu-cau-xoa"],

    computed: {
        // Tính thành tiền
        thanhTien() {
            return this.item.donGia * this.item.soLuong;
        }
    },

    methods: {
        // Tăng số lượng
        tangSoLuong() {
            const newQuantity = this.item.soLuong + 1;

            if (newQuantity <= 99) {
                this.$emit(
                    "doi-so-luong",
                    this.item.id,
                    newQuantity
                );
            }
        },

        // Giảm số lượng
        giamSoLuong() {
            const newQuantity = this.item.soLuong - 1;

            if (newQuantity >= 1) {
                this.$emit(
                    "doi-so-luong",
                    this.item.id,
                    newQuantity
                );
            }
        },

        // Yêu cầu xóa sản phẩm
        xoaSanPham() {
            this.$emit("yeu-cau-xoa", this.item.id);
        },

        // Định dạng giá tiền
        formatPrice(price) {
            return price.toLocaleString("vi-VN") + " đồng";
        }
    },

    template: `
        <tr>
            <td>{{ item.id }}</td>

            <td>{{ item.ten }}</td>

            <td>{{ formatPrice(item.donGia) }}</td>

            <td>
                <button
                    @click="giamSoLuong"
                    :disabled="item.soLuong <= 1"
                >
                    -
                </button>

                {{ item.soLuong }}

                <button
                    @click="tangSoLuong"
                    :disabled="item.soLuong >= 99"
                >
                    +
                </button>
            </td>

            <td>{{ formatPrice(thanhTien) }}</td>

            <td>
                <button
                    @click="xoaSanPham"
                    class="delete-btn"
                >
                    Xóa
                </button>
            </td>
        </tr>
    `
};
