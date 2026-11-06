
const app = Vue.createApp({
    data() {
        return {
            pageStatus: "Đang tải...",
            keyword: "",
            searchMessage: "",
            selectedCategory: "",
            sortOrder: "",
            errorMessage: "",

            categories: [
                "Điện thoại",
                "Laptop",
                "Camera"
            ],

            products: [
                {
                    id: 1,
                    name: "iPhone 18 Pro 256GB",
                    price: 38690000,
                    category: "Điện thoại",
                    stock: 5
                },
                {
                    id: 2,
                    name: "iPhone 17 Pro Max 256GB",
                    price: 34990000,
                    category: "Điện thoại",
                    stock: 3
                },
                {
                    id: 3,
                    name: "Laptop ASUS Zenbook 14 UX3405CA-ST1713W",
                    price: 32490000,
                    category: "Laptop",
                    stock: 1
                },
                {
                    id: 4,
                    name: "Laptop Lenovo IdeaPad Slim 3 14IPH11 83UQ003NVN",
                    price: 24490000,
                    category: "Laptop",
                    stock: 0
                },
                {
                    id: 5,
                    name: "DJI Pocket 3 Creator Combo",
                    price: 11281000,
                    category: "Camera",
                    stock: 4
                },
                {
                    id: 6,
                    name: "Máy ảnh Canon PowerShot V1",
                    price: 23490000,
                    category: "Camera",
                    stock: 0
                }
            ],

            newProduct: {
                name: "",
                price: null,
                category: "",
                stock: null
            }
        };
    },

    computed: {
        // Tìm kiếm, lọc và sắp xếp sản phẩm
        filteredProducts() {
            let result = this.products.filter(product => {
                const matchName = product.name
                    .toLowerCase()
                    .includes(this.keyword.trim().toLowerCase());

                const matchCategory =
                    this.selectedCategory === "" ||
                    product.category === this.selectedCategory;

                return matchName && matchCategory;
            });

            // Sắp xếp mà không thay đổi mảng gốc
            if (this.sortOrder === "asc") {
                result = result.slice().sort(
                    (a, b) => a.price - b.price
                );
            } else if (this.sortOrder === "desc") {
                result = result.slice().sort(
                    (a, b) => b.price - a.price
                );
            }

            return result;
        },

        // Tổng giá trị tồn kho của sản phẩm đang hiển thị
        totalInventoryValue() {
            return this.filteredProducts.reduce(
                (total, product) => {
                    return total + product.price * product.stock;
                },
                0
            );
        }
    },

    watch: {
        // Theo dõi từ khóa tìm kiếm
        keyword(newValue) {
            if (newValue.length === 1) {
                this.searchMessage =
                    "Vui lòng nhập ít nhất 2 ký tự để tìm kiếm.";
            } else {
                this.searchMessage = "";
            }
        }
    },

    methods: {
        // Định dạng giá tiền
        formatPrice(price) {
            return price.toLocaleString("vi-VN") + " VNĐ";
        },

        // Thêm sản phẩm
        addProduct() {
            this.errorMessage = "";

            const name = this.newProduct.name.trim();
            const price = this.newProduct.price;
            const category = this.newProduct.category;
            const stock = this.newProduct.stock;

            if (name === "") {
                this.errorMessage = "Tên sản phẩm không được để trống.";
                return;
            }

            if (
                price === null ||
                price === "" ||
                !Number.isFinite(price) ||
                price <= 0
            ) {
                this.errorMessage = "Giá phải lớn hơn 0.";
                return;
            }

            if (!category) {
                this.errorMessage = "Vui lòng chọn danh mục.";
                return;
            }

            if (
                stock === null ||
                stock === "" ||
                !Number.isInteger(stock) ||
                stock < 0
            ) {
                this.errorMessage =
                    "Số lượng tồn phải là số nguyên không âm.";
                return;
            }

            const newId = Math.max(
                0,
                ...this.products.map(product => product.id)
            ) + 1;

            this.products.push({
                id: newId,
                name: name,
                price: price,
                category: category,
                stock: stock
            });

            this.newProduct = {
                name: "",
                price: null,
                category: "",
                stock: null
            };
        },

        // Xóa sản phẩm
        deleteProduct(id) {
            const confirmed = confirm(
                "Bạn có chắc chắn muốn xóa sản phẩm này không?"
            );

            if (confirmed) {
                this.products = this.products.filter(
                    product => product.id !== id
                );
            }
        }
    },

    // Đặt trạng thái trang sau khi khởi tạo
    mounted() {
        this.pageStatus = "Sẵn sàng";
    }
});

app.mount("#app");
