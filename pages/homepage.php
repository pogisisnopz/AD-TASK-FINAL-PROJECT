<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ValoSkins - Premium Valorant Skins Store</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/homepage.css">
</head>
<body>
   

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <i class="fas fa-crosshairs"></i>
            <span>ABLE PLAY</span>
        </div>
        <div class="nav-links">
            <a href="#home" class="nav-link active">Home</a>
            <a href="#skins" class="nav-link">Skins</a>
             <a href="contact.php" class="nav-link">Contact Us</a>
</div>
            
        <div class="nav-actions">
            <div class="search-box">
                <input type="text" placeholder="Search skins..." id="searchInput">
                <i class="fas fa-search"></i>
            </div>
            <div class="cart-icon" onclick="toggleCart()">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count" id="cartCount">0</span>
            </div>
            <a href="../index.php" class="back-to-profile-btn">
                <i class="fas fa-user"></i>
                Back to Profile
            </a>
        </div>
    </div>
</nav>
   

    
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-content">
            
            <h1 class="hero-title">ValoSkins</h1>
            <p class="hero-subtitle">Discover premium Valorant skins and elevate your gaming experience</p>
            <button class="cta-button" onclick="scrollToSkins()">
                <i class="fas fa-rocket"></i>
                Shop Now
            </button>
             
        </div>
    </section>

   

  
    <section class="skins-section" id="skins">
        <div class="container">
            <h2 class="section-title">Featured Skins</h2>
            
            <div class="filter-tabs">
                <button class="filter-tab active" onclick="filterSkins('all')">All Skins</button>
                <button class="filter-tab" onclick="filterSkins('rifles')">Rifles</button>
                <button class="filter-tab" onclick="filterSkins('pistols')">Pistols</button>
                <button class="filter-tab" onclick="filterSkins('knives')">Knives</button>
            </div>

            <div class="skins-grid" id="skinsGrid">
               
            </div>
        </div>
    </section>

    
    <div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>Shopping Cart</h3>
            <button class="close-cart" onclick="toggleCart()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-items" id="cartItems">
            <div class="empty-cart">Your cart is empty</div>
        </div>
        <div class="cart-footer">
            <div class="cart-total" id="cartTotal">Total: ₱0</div>
            <button class="checkout-btn" id="checkoutBtn" onclick="showCheckoutModal()" disabled>
                <i class="fas fa-credit-card"></i>
                Checkout
            </button>
        </div>
    </div>

   
    <div class="modal-overlay" id="checkoutModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-credit-card"></i> Checkout</h3>
                <button class="close-modal" onclick="closeCheckoutModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="checkoutForm" class="checkout-form">
                <div class="form-group">
                    <label for="valoIgn">
                        <i class="fas fa-user"></i>
                        Valorant IGN (e.g., snopz#whouu)
                    </label>
                    <input type="text" id="valoIgn" name="valoIgn" placeholder="Enter your Valorant IGN with tag" required>
                    <small>Please include your tag number (e.g., #1234)</small>
                </div>
                <div class="form-group">
                    <label for="paymentMethod">
                        <i class="fas fa-wallet"></i>
                        Payment Method
                    </label>
                    <select id="paymentMethod" name="paymentMethod" required>
                        <option value="">Select Payment Method</option>
                        <option value="gcash">GCash</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                    </select>
                </div>
                <div class="checkout-summary">
                    <h4>Order Summary</h4>
                    <div id="checkoutItems"></div>
                    <div class="checkout-total">
                        <strong id="checkoutTotalAmount">Total: ₱0</strong>
                    </div>
                </div>
                <button type="submit" class="complete-purchase-btn">
                    <i class="fas fa-lock"></i>
                    Complete Purchase
                </button>
            </form>
        </div>
    </div>

 
    <div class="modal-overlay" id="confirmationModal">
        <div class="modal-content confirmation-modal">
            <div class="confirmation-header">
                <i class="fas fa-check-circle"></i>
                <h3>Purchase Successful!</h3>
            </div>
            <div class="confirmation-content">
                <div class="purchase-info">
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <span>Valorant IGN:</span>
                        <strong id="confirmedIgn"></strong>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-wallet"></i>
                        <span>Payment Method:</span>
                        <strong id="confirmedPayment"></strong>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar"></i>
                        <span>Purchase Date:</span>
                        <strong id="confirmedDate"></strong>
                    </div>
                </div>
                <div class="purchased-items">
                    <h4><i class="fas fa-shopping-bag"></i> Items Purchased:</h4>
                    <div id="confirmedItems"></div>
                </div>
                <div class="confirmation-total">
                    <strong id="confirmedTotal">Total Paid: ₱0</strong>
                </div>
                <p class="delivery-note">
                    <i class="fas fa-info-circle"></i>
                    Your skins will be delivered to your Valorant account within 24 hours.
                </p>
            </div>
            <button class="close-confirmation-btn" onclick="closeConfirmationModal()">
                <i class="fas fa-check"></i>
                Close
            </button>
        </div>
    </div>

    
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Item added to cart!</span>
    </div>

    <script>
       
        const skins = [
          
    {
        id: 1,
        name: "Phantom - Singularity",
        price: 2175,
        image: "https://valorantstrike.com/wp-content/uploads/2020/10/Valorant-Singularity-Collection-Phantom-HD.jpg",
        category: "rifles",
        rarity: "ultra"
    },
    {
        id: 2,
        name: "Vandal - Prime",
        price: 1775,
        image: "https://valorantstrike.com/wp-content/uploads/2020/06/Valorant-Prime-Vandal-Blue-Variant-2.jpg",
        category: "rifles",
        rarity: "premium"
    },
    {
        id: 3,
        name: "Sheriff - Ion",
        price: 1775,
        image: "https://static1.thegamerimages.com/wordpress/wp-content/uploads/2023/02/an-image-of-the-ion-sheriff.jpg",

        category: "pistols",
        rarity: "premium"
    },
    {
        id: 4,
        name: "Knife - Reaver",
        price: 4350,
        image: "https://cdn.shopify.com/s/files/1/0249/9434/9161/files/valorant_reaver_knife_replica_3d_model_2.jpg?v=1656570278",
        category: "knives",
        rarity: "ultra"
    },
    {
        id: 5,
        name: "Operator - Elderflame",
        price: 2175,
        image: "https://static1.thegamerimages.com/wordpress/wp-content/uploads/2023/03/an-image-of-the-elderflame-operator.jpg",
        category: "rifles",
        rarity: "ultra"
    },
    {
        id: 6,
        name: "Sovereign Guardian",
        price: 875,
        image: "https://valorantstrike.com/wp-content/uploads/2020/06/Valorant-Sovereign-Guardian-HD.jpg",
        category: "rifles",
        rarity: "premium"
    },
    
    {
        id: 7,
        name: "Prelude to Chaos Vandal",
        price: 2175,
        image: "https://valorantstrike.com/wp-content/uploads/Valorant-Prelude-to-Chaos-Collection-Vandal-Blue.jpg",
        category: "rifles",
        rarity: "ultra"
    },
    {
        id: 8,
        name: "Kuronami Vandal",
        price: 2175,
        image: "https://valorantstrike.com/wp-content/uploads/Valorant-Kuronami-Collection-Vandal-Purple.jpg",
        category: "rifles",
        rarity: "ultra"
    },
    {
        id: 9,
        name: "Recon Phantom",
        price: 1775,
        image: "https://valorantstrike.com/wp-content/uploads/2021/08/Valorant-Recon-Collection-Phantom-Red-Variant.jpg",
        category: "rifles",
        rarity: "premium"
    },
    {
        id: 10,
        name: "Oni Phantom",
        price: 1775,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVjc4cZAECeHbL_xSeDfe_ylFudQbf0tcYlw&s",
        category: "rifles",
        rarity: "premium"
    },
    {
        id: 11,
        name: "Reaver Guardian",
        price: 1775,
        image: "https://valorantstrike.com/wp-content/uploads/2020/10/Valorant-Reaver-Collection-Guardian-HD.jpg",
        category: "rifles",
        rarity: "premium"
    },
    {
        id: 12,
        name: "Reaver Operator",
        price: 2175,
        image: "https://valorantstrike.com/wp-content/uploads/2020/11/Valorant-Reaver-Collection-Operator-Red-Variant.jpg",
        category: "rifles",
        rarity: "ultra"
    },
    {
        id: 13,
        name: "Ion Operator",
        price: 2175,
        image: "https://valorantstrike.com/wp-content/uploads/2020/11/Valorant-Ion-Collection-Operator-HD.jpg",
        category: "rifles",
        rarity: "ultra"
    },
    {
        id: 14,
        name: "Glitchpop Bulldog",
        price: 1775,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlGd-HFzK-ljtGQwxRHrY_THxIhnBHEHte3Q&s",
        category: "rifles",
        rarity: "premium"
    },
    
    {
        id: 15,
        name: "Sovereign Ghost",
        price: 875,
        image: "https://valorantstrike.com/wp-content/uploads/2020/06/Valorant-Sovereign-Ghost-Purple-Variant.jpg",
        category: "pistols",
        rarity: "premium"
    },
    {
        id: 16,
        name: "Reaver Ghost",
        price: 875,
        image: "https://valorantstrike.com/wp-content/uploads/Valorant-Reaver-2-Collection-Ghost-HD.jpg",
        category: "pistols",
        rarity: "premium"
    },
    {
        id: 17,
        name: "Singularity Sheriff",
        price: 1775,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSifAgq4iXfkiiMhg6Jj51bqnPtXJ171gFg9A&s",
        category: "pistols",
        rarity: "ultra"
    },
    {
        id: 18,
        name: "Kuronami Sheriff",
        price: 1775,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2R8lfM0ys_FPNypSlpjNbYJ_g8IjduMn8JQ&s",
        category: "pistols",
        rarity: "ultra"
    },
    
    {
        id: 19,
        name: "Kuronami no Yaiba",
        price: 4350,
        image: "https://cdn.shopify.com/s/files/1/0249/9434/9161/files/Kuronami-knife-project_480x480.jpg?v=1714124471",
        category: "knives",
        rarity: "ultra"
    },
    {
        id: 20,
        name: "Oni Katana",
        price: 4350,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCs_akiGzN6u8BBvUHcYThIF0EpZxGQMKEPQ&s",
        category: "knives",
        rarity: "ultra"
    },
    {
        id: 21,
        name: "Reaver Karambit",
        price: 4350,
        image: "https://valorantstrike.com/wp-content/uploads/Valorant-Reaver-2-Collection-Karambit-HD.jpg",
        category: "knives",
        rarity: "ultra"
    },
    {
        id: 22,
        name: "RGX Butterfly Knife",
        price: 4350,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyARe1_Gg5GkE_YLRDqqwCVqKqyvATSmfl0A&s",
        category: "knives",
        rarity: "ultra"
    }
];
        
        let cart = [];

        function renderSkins(skinsToRender = skins) {
            const skinsGrid = document.getElementById('skinsGrid');
            skinsGrid.innerHTML = '';

            skinsToRender.forEach(skin => {
                const skinCard = document.createElement('div');
                skinCard.className = 'skin-card';
                skinCard.innerHTML = `
                    <div class="skin-image">
                        <img src="${skin.image}" alt="${skin.name}" loading="lazy">
                        <div class="skin-rarity ${skin.rarity}">${skin.rarity}</div>
                    </div>
                    <div class="skin-info">
                        <h3 class="skin-name">${skin.name}</h3>
                        <div class="skin-price">₱${skin.price}</div>
                        <button class="add-to-cart-btn" onclick="addToCart(${skin.id})">
                            <i class="fas fa-shopping-cart"></i>
                            Add to Cart
                        </button>
                    </div>
                `;
                skinsGrid.appendChild(skinCard);
            });
        }

        function filterSkins(category) {
            
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

           
            const filteredSkins = category === 'all' 
                ? skins 
                : skins.filter(skin => skin.category === category);
            
            renderSkins(filteredSkins);
        }

        function addToCart(skinId) {
            const skin = skins.find(s => s.id === skinId);
            const existingItem = cart.find(item => item.id === skinId);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ ...skin, quantity: 1 });
            }

            updateCartUI();
            showToast(`${skin.name} added to cart!`, 'success');
        }

        function removeFromCart(skinId) {
            cart = cart.filter(item => item.id !== skinId);
            updateCartUI();
            showToast('Item removed from cart', 'error');
        }

        function updateQuantity(skinId, change) {
            const item = cart.find(item => item.id === skinId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(skinId);
                } else {
                    updateCartUI();
                }
            }
        }

        function updateCartUI() {
            const cartCount = document.getElementById('cartCount');
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            const checkoutBtn = document.getElementById('checkoutBtn');

            
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;

            
            if (cart.length === 0) {
                cartItems.innerHTML = '<div class="empty-cart">Your cart is empty</div>';
                checkoutBtn.disabled = true;
            } else {
                cartItems.innerHTML = cart.map(item => `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        <div class="cart-item-info">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">₱${item.price}</div>
                            <div class="cart-item-quantity">
                                Qty: ${item.quantity}
                                <div class="quantity-controls">
                                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                                </div>
                            </div>
                        </div>
                        <button class="remove-item" onclick="removeFromCart(${item.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `).join('');
                checkoutBtn.disabled = false;
            }

            
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            cartTotal.textContent = `Total: ₱${total}`;

            
            if (totalItems > 0) {
                cartCount.classList.add('bounce');
                setTimeout(() => cartCount.classList.remove('bounce'), 500);
            }
        }

        function toggleCart() {
            const cartSidebar = document.getElementById('cartSidebar');
            const cartOverlay = document.getElementById('cartOverlay');
            
            cartSidebar.classList.toggle('active');
            cartOverlay.classList.toggle('active');
        }

        function showCheckoutModal() {
            if (cart.length === 0) return;
            
            const modal = document.getElementById('checkoutModal');
            const checkoutItems = document.getElementById('checkoutItems');
            const checkoutTotalAmount = document.getElementById('checkoutTotalAmount');
            
            
            checkoutItems.innerHTML = cart.map(item => `
                <div class="checkout-item">
                    <img src="${item.image}" alt="${item.name}" class="checkout-item-image">
                    <div class="checkout-item-info">
                        <div class="checkout-item-name">${item.name}</div>
                        <div class="checkout-item-details">
                            <span>₱${item.price} × ${item.quantity}</span>
                            <span class="checkout-item-subtotal">₱${item.price * item.quantity}</span>
                        </div>
                    </div>
                </div>
            `).join('');
            
            
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            checkoutTotalAmount.textContent = `Total: ₱${total}`;
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkoutModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            
            document.getElementById('checkoutForm').reset();
        }

        function showConfirmationModal(purchaseData) {
            const modal = document.getElementById('confirmationModal');
            const confirmedIgn = document.getElementById('confirmedIgn');
            const confirmedPayment = document.getElementById('confirmedPayment');
            const confirmedDate = document.getElementById('confirmedDate');
            const confirmedItems = document.getElementById('confirmedItems');
            const confirmedTotal = document.getElementById('confirmedTotal');
            
           
            confirmedIgn.textContent = purchaseData.valoIgn;
            confirmedPayment.textContent = getPaymentMethodName(purchaseData.paymentMethod);
            confirmedDate.textContent = new Date().toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            
            confirmedItems.innerHTML = purchaseData.items.map(item => `
                <div class="confirmed-item">
                    <img src="${item.image}" alt="${item.name}" class="confirmed-item-image">
                    <div class="confirmed-item-info">
                        <div class="confirmed-item-name">${item.name}</div>
                        <div class="confirmed-item-details">
                            <span>Qty: ${item.quantity}</span>
                            <span class="confirmed-item-price">₱${item.price * item.quantity}</span>
                        </div>
                    </div>
                </div>
            `).join('');
            
            confirmedTotal.textContent = `Total Paid: ₱${purchaseData.total}`;
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeConfirmationModal() {
            const modal = document.getElementById('confirmationModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function getPaymentMethodName(method) {
            const methods = {
                'gcash': 'GCash',
                'bank_transfer': 'Bank Transfer',
                'credit_card': 'Credit Card',
                'debit_card': 'Debit Card'
            };
            return methods[method] || method;
        }

        
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const valoIgn = formData.get('valoIgn');
            const paymentMethod = formData.get('paymentMethod');
            
          
            if (!valoIgn.includes('#')) {
                showToast('Please include your tag number (e.g., #1234)', 'error');
                return;
            }
            
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            const purchaseData = {
                valoIgn: valoIgn,
                paymentMethod: paymentMethod,
                items: [...cart],
                total: total
            };
            
           
            closeCheckoutModal();
            
          
            showToast('Processing your purchase...', 'success');
            
            
            setTimeout(() => {
                
                cart = [];
                updateCartUI();
                toggleCart();
                
                
                showConfirmationModal(purchaseData);
                
                showToast('Purchase completed successfully!', 'success');
            }, 2000);
        });

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            
            toastMessage.textContent = message;
            toast.className = `toast ${type}`;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        function scrollToSkins() {
            document.getElementById('skins').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }

       
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const filteredSkins = skins.filter(skin => 
                skin.name.toLowerCase().includes(searchTerm)
            );
            renderSkins(filteredSkins);
        });

        
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').slice(1) === current) {
                    link.classList.add('active');
                }
            });
        });

        
        document.addEventListener('DOMContentLoaded', function() {
            renderSkins();
            updateCartUI();
        });

        
        document.addEventListener('click', function(e) {
            const cartSidebar = document.getElementById('cartSidebar');
            const cartIcon = document.querySelector('.cart-icon');
            
            if (!cartSidebar.contains(e.target) && !cartIcon.contains(e.target)) {
                if (cartSidebar.classList.contains('active')) {
                    toggleCart();
                }
            }
        });

        
        document.addEventListener('click', function(e) {
            const checkoutModal = document.getElementById('checkoutModal');
            const confirmationModal = document.getElementById('confirmationModal');
            
            if (e.target === checkoutModal) {
                closeCheckoutModal();
            }
            
            if (e.target === confirmationModal) {
                closeConfirmationModal();
            }
        });
    </script>
</body>
</html>