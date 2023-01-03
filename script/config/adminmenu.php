<?php

return [
    [
        "header" => "Dashboard",
        "can" => ['dashboard-read']
    ],
    [
        "title" => "Dashboard",
        "icon" => "fas fa-tachometer-alt",
        "route" => "admin.dashboard.index",
        "patterns" => ["admin/dashboard*"],
        "can" => ['dashboard-read']
    ],
    [
        "title" => "Customers",
        "icon" => "fas fa-users",
        "route" => "admin.customers.index",
        "patterns" => ["admin/customers*"],
        "can" => ['customers-read']
    ],
    [
        "title" => "Promotional Email",
        "icon" => "fas fa-envelope",
        "route" => "admin.promotional-email.index",
        "patterns" => ["admin/promotional-email*"],
        "can" => ['promotional-email-read']
    ],
    [
        "title" => "Supports",
        "icon" => "fas fa-headphones",
        "route" => "admin.supports.index",
        "patterns" => ["admin/supports*"],
        "can" => ['supports-read']
    ],
    ['header' => 'Transaction Logs'],
    [
        "title" => "Transactions",
        "icon" => "fas fa-exchange-alt",
        "route" => "admin.transactions.index",
        "patterns" => ["admin/transactions*"],
        "can" => ['transactions-read']
    ],
    [
        "title" => "Payments",
        "icon" => "fas fa-list",
        "patterns" => ["admin/payments*"],
        "can" => ['payments-read'],
        "submenu" => [
            [
                "title" => "Donations",
                "route" => "admin.payments.donations.index",
                "patterns" => ["admin/payments/donations"],
                "can" => ['payments-read'],
            ],
            [
                "title" => "Single Charge",
                "route" => "admin.payments.single-charge.index",
                "patterns" => ["admin/payments/single-charge"],
                "can" => ['payments-read'],
            ],
        ]
    ],
    [
        "title" => "Invoices",
        "icon" => "fas fa-file-invoice",
        "route" => "admin.invoices.index",
        "patterns" => ["admin/invoices*"],
        "can" => ['invoices-read'],
    ],
    [
        "title" => "Merchants",
        "icon" => "fas fa-store",
        "route" => "admin.merchants.index",
        "patterns" => ["admin/merchants*"],
        "can" => ['merchants-read'],
    ],
    [
        "title" => "Categories",
        "icon" => "fas fa-sitemap",
        "route" => "admin.categories.index",
        "patterns" => ["admin/categories*"],
        "can" => ['category-read'],
    ],
    [
        "title" => "Products",
        "icon" => "fab fa-product-hunt",
        "route" => "admin.products.index",
        "patterns" => ["admin/products*"],
        "can" => ['products-read'],
    ],
    [
        "title" => "Deposit",
        "icon" => "fas fa-money-check",
        "route" => "admin.deposits.index",
        "patterns" => ["admin/deposits*"],
        "can" => ['deposits-read'],
    ],
    [
        "title" => "Stores",
        "icon" => "fas fa-shopping-bag",
        "route" => "admin.stores.index",
        "patterns" => ["admin/stores*"],
        "can" => ['stores-read'],
    ],
    [
        "title" => "Money Requests",
        "icon" => "fas fa-money-check-alt",
        "route" => "admin.money-requests.index",
        "patterns" => ["admin/money-requests*"],
        "can" => ['money-requests-read'],
    ],
    [
        "title" => "Money Transfers",
        "icon" => "fas fa-file-invoice-dollar",
        "route" => "admin.transfers.index",
        "patterns" => ["admin/transfers*"],
        "can" => ['transfers-read'],
    ],
    [
        "title" => "Payment Plans",
        "icon" => "fas fa-layer-group",
        "route" => "admin.payment-plans.index",
        "patterns" => ["admin/payment-plans*"],
        "can" => ['payment-plans-read'],
    ],
    [
        "title" => "Payouts",
        "icon" => "fas fa-arrow-down",
        "route" => "admin.payouts.index",
        "patterns" => ["admin/payouts*"],
        "can" => ['payouts-read'],
    ],
    [
        "title" => "Banks",
        "icon" => "fas fa-building",
        "route" => "admin.banks.index",
        "patterns" => ["admin/banks*"],
        "can" => ['banks-read'],
    ],
    [
        "title" => "Manage Orders",
        "icon" => "fas fa-th-list",
        "route" => "admin.orders.index",
        "patterns" => ["admin/orders*"],
        "can" => ['orders-read'],
    ],
    [
        "title" => "Country & currency",
        "icon" => "fas fa-globe",
        "patterns" => ["admin/currencies*"],
        "can" => ['currencies-read'],
        "submenu" => [
            [
                "title" => "Create currency",
                "route" => "admin.currencies.create",
                "patterns" => ["admin/currencies/create"],
                "can" => ['currencies-create'],
            ],
            [
                "title" => "Manage currency",
                "route" => "admin.currencies.index",
                "patterns" => ["admin/currencies"],
                "can" => ['currencies-read'],
            ],
        ]
    ],
    [
        "title" => "Bank supported",
        "icon" => "fas fa-university",
        "route" => "admin.banks.index",
        "patterns" => ["admin/banks*"],
        "can" => ['banks-read'],
    ],
    ["header" => "User Management", "can" => ["users-read"]],
    [
        "title" => "Users",
        "icon" => "fas fa-users",
        "patterns" => ["admin/users*"],
        "can" => ['users-read'],
        "submenu" => [
            [
                "title" => "Create user",
                "route" => "admin.users.create",
                "patterns" => ["admin/users/create"],
                "can" => ['users-create'],
            ],
            [
                "title" => "Manage users",
                "route" => "admin.users.index",
                "patterns" => ["admin/users"],
                "can" => ['users-read'],
            ],
        ]
    ],
    ["header" => "Kyc Management", "can" => ['kyc-methods-read', 'kyc-requests-read'],],
    [
        "title" => "Kyc Methods",
        "icon" => "fas fa-user-lock",
        "patterns" => ["admin/kyc-method*"],
        "can" => ['kyc-methods-read'],
        "submenu" => [
            [
                "title" => "Create Method",
                "route" => "admin.kyc-method.create",
                "patterns" => ["admin/kyc-method/create"],
                "can" => ['kyc-methods-create'],
            ],
            [
                "title" => "Manage Methods",
                "route" => "admin.kyc-method.index",
                "patterns" => ["admin/kyc-method"],
                "can" => ['kyc-methods-read'],
            ],
        ]
    ],
    [
        "title" => "Kyc Requests",
        "icon" => "fas fa-user-shield",
        "route" => "admin.kyc-requests.index",
        "patterns" => ["admin/kyc-requests*"],
        "can" => ['kyc-requests-read'],
    ],
    ["header" => "Website Management", "can" => ['website-read', 'website-update'],],
    [
        "title" => "Media",
        "icon" => "far fa-file-image",
        "route" => "admin.media.list",
        "patterns" => ["admin/media*"],
        "can" => ['media-read'],
    ],
    [
        "title" => "Reviews",
        "icon" => "fas fa-comments",
        "patterns" => ["admin/reviews*"],
        "can" => ['reviews-read', 'reviews-create'],
        "submenu" => [
            [
                "title" => "Create Review",
                "route" => "admin.reviews.create",
                "patterns" => ["admin/reviews/create"],
                "can" => ['reviews-create'],
            ],
            [
                "title" => "Manage Reviews",
                "route" => "admin.reviews.index",
                "patterns" => ["admin/reviews"],
                "can" => ['reviews-read'],
            ],
        ]
    ],
    [
        "title" => "Blog",
        "icon" => "fab fa-blogger",
        "patterns" => ["admin/blog*"],
        "can" => ['blog-read', 'blog-create'],
        "submenu" => [
            [
                "title" => "Create Post",
                "route" => "admin.blog.create",
                "patterns" => ["admin/blog/create"],
                "can" => ['blog-create'],
            ],
            [
                "title" => "Manage Posts",
                "route" => "admin.blog.index",
                "patterns" => ["admin/blog"],
                "can" => ['blog-read'],
            ],
        ]
    ],
    [
        "title" => "Page",
        "icon" => "fas fa-file",
        "patterns" => ["admin/page*"],
        "can" => ['pages-read', 'pages-create'],
        "submenu" => [
            [
                "title" => "Create Custom Pages",
                "route" => "admin.page.index",
                "patterns" => ["admin/page"],
                "can" => ['pages-create'],
            ],
            [
                "title" => "Manage Custom Pages",
                "route" => "admin.page.index",
                "patterns" => ["admin/page"],
                "can" => ['pages-read'],
            ],
        ]
    ],
    [
        "title" => "Settings",
        "icon" => "fas fa-cogs",
        "patterns" => ['admin/settings', 'admin/language/*', 'admin/menu/*'],
        "can" => ['settings-read', 'languages-read', 'menus-read', 'seo-read', 'system-settings-read', 'cron-settings', /*'taxes-read',*/ 'gateways-read', 'roles-read', 'roles-assign'],
        "submenu" => [
            [
                "title" => "Logo",
                "route" => "admin.settings.website.logo.index",
                "patterns" => ["admin/settings/website/logo/index"],
                "can" => ['website-read', 'website-update'],
            ],
            [
                "title" => "Footer",
                "route" => "admin.settings.website.footer.index",
                "patterns" => ["admin/settings/website/footer"],
                "can" => ['website-read', 'website-update'],
            ],
            [
                "title" => "Charges",
                "route" => "admin.settings.charges.index",
                "patterns" => ["admin/settings/charges*"],
                "can" => ['languages-read'],
            ],
            [
                "title" => "Language",
                "route" => "admin.language.index",
                "patterns" => ["admin/language*"],
                "can" => ['languages-read'],
            ],
            [
                "title" => "Staff",
                "route" => "admin.staff.index",
                "patterns" => ["admin/staff*"],
                "can" => ['staff-read'],
            ],
            [
                "title" => "Menu Settings",
                "route" => "admin.menu.index",
                "patterns" => ["admin/menu*"],
                "can" => ['menus-read'],
            ],
            [
                "title" => "SEO Settings",
                "route" => "admin.seo.index",
                "patterns" => ["admin/seo*"],
                "can" => ['seo-read'],
            ],
            [
                "title" => "System Settings",
                "route" => "admin.env.index",
                "patterns" => ["admin/env*"],
                "can" => ['system-settings-read'],
            ],
            [
                "title" => "Cron Settings",
                "route" => "admin.cron.index",
                "patterns" => ["admin/cron*"],
                "can" => ['cron-settings-read'],
            ],
            [
                "title" => "Currencies Settings",
                "route" => "admin.currencies.index",
                "patterns" => ["admin/currencies*"],
                "can" => ['currencies-read'],
            ],
            [
                "title" => "Gateway Settings",
                "route" => "admin.payment-gateways.index",
                "patterns" => ["admin/payment-gateways*"],
                "can" => ['gateways-read'],
            ],
            [
                "title" => "Roles",
                "route" => "admin.roles.index",
                "patterns" => ["admin/roles*"],
                "can" => ['roles-read'],
            ],
            [
                "title" => "Assign Role",
                "route" => "admin.assign-role.index",
                "patterns" => ["admin/assign-role*"],
                "can" => ['roles-assign-read'],
            ],
            [
                "title" => "Signup Fields",
                "route" => "admin.signup-fields.index",
                "patterns" => ["admin/signup-fields*"],
                "can" => ['signup-fields-read'],
            ],
        ]
    ],
];
