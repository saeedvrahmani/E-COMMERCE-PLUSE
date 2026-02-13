/**
 =========================================================
 * Material Dashboard 2 React - v2.1.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/material-dashboard-react
 * Copyright 2022 Creative Tim (https://www.creative-tim.com)

 Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 */

/**
 All of the routes for the Material Dashboard 2 React are added here,
 You can add a new route, customize the routes and delete the routes here.

 Once you add a new route on this file it will be visible automatically on
 the Sidenav  .

 For adding a new route you can follow the existing routes in the routes array.
 1. The `type` key with the `collapse` value is used for a route.
 2. The `type` key with the `title` value is used for a title inside the Sidenav.
 3. The `type` key with the `divider` value is used for a divider between Sidenav items.
 4. The `name` key is used for the name of the route on the Sidenav.
 5. The `key` key is used for the key of the route (It will help you with the key prop inside a loop).
 6. The `icon` key is used for the icon of the route on the Sidenav, you have to add a node.
 7. The `collapse` key is used for making a collapsible item on the Sidenav that has other routes
 inside (nested routes), you need to pass the nested routes inside an array as a value for the `collapse` key.
 8. The `route` key is used to store the route location which is used for the react router.
 9. The `href` key is used to store the external links location.
 10. The `title` key is only for the item with the type of `title` and its used for the title text on the Sidenav.
 10. The `component` key is used to store the component of its route.
 */

// Material Dashboard 2 React layouts
import Dashboard from "layouts/dashboard";
import Tables from "layouts/tables";
import Billing from "layouts/billing";
import RTL from "layouts/rtl";
import Notifications from "layouts/notifications";
import Profile from "layouts/profile";
import Settings from "layouts/settings";
import SignIn from "layouts/authentication/sign-in";
import SignUp from "layouts/authentication/sign-up";

import UserProfile from "layouts/user-profile";
import UserManagement from "layouts/user-management";

import Login from "auth/login";
import Register from "auth/register";
import ForgotPassword from "auth/forgot-password";
import ResetPassword from "auth/reset-password";

// @mui icons
import Icon from "@mui/material/Icon";
import ProductsPage from "./layouts/productPage";
import OrdersPage from "./layouts/orderpage";

const routes = [
  {
    type: "collapse",
    name: "Dashboard",
    key: "dashboard",
    role:"super-admin|employ|author",
    icon: <Icon fontSize="small">dashboard</Icon>,
    route: "/dashboard",
    component: <Dashboard />,
  },
  {
    type: "collapse",
    name: "Profile",
    key: "profile",
    icon: <Icon fontSize="small">person</Icon>,
    route: "/profile",
    component: <Profile />,
  },
  {
    type: "collapse",
    name: "E-Commerce",
    key: "ecommerce",
    icon: <Icon fontSize="small">shopping_cart</Icon>,
    collapse: [
      {
        type: "collapse",
        name: "Products",
        key: "products",
        icon: <Icon>inventory_2</Icon>,
        collapse: [
          {
            type: "route",
            icon: "add_box",
            roles:['super-admin','employ'],
            name: "New-Products",
            key: "newProducts",
            route: "/new-products",
            component: <ProductsPage />,
          },
          {
            type: "route",
            icon: "mode_edit",
            roles:['super-admin','employ'],
            name: "Edit-Products",
            key: "editProducts",
            route: "/edit-products",
            component: <ProductsPage />,
          },
        ],
      },
      {
        type: "collapse",
        name: "Orders",
        icon: "shopping_cart",
        key: "orders",
        component: <OrdersPage />,
        collapse: [
          {
            type: "route",
            name: "No-Sent-Orders",
            icon: "HourglassEmpty",
            key: "NoSentOrder",
            route: "/no-sent-order",
            component: <OrdersPage />,
          },
          {
            type: "route",
            name: "All-Orders",
            icon: "A",
            key: "AllOrders",
            route: "/all-order",
            component: <OrdersPage />,
          },
        ],
      },
      {
        type:"collapse",
        name:"Attributes",
        key:"attributes",
        icon:<Icon fontSize='small'>label</Icon>,
        collapse: [
          {
            type: "route",
            name: "Create-New",
            icon: "C",
            roles:['super-admin','employ'],
            key: "CreateNew",
            route: "/create-new-attributes",
            component: <OrdersPage />,
          },
        ],
      },
      {
        type:"collapse",
        name:"Categories",
        key:"categories",
        icon:<Icon fontSize='small'>category</Icon>,
        collapse: [
          {
            type: "route",
            name: "Create",
            icon: "C",
            roles:['super-admin','employ'],
            key: "create",
            route: "/create-category",
            component: <OrdersPage />,
          },
          {
            type: "route",
            name: "Browse",
            icon: "B",
            key: "Browse",
            route: "/browse-category",
            component: <OrdersPage />,
          },
        ],
      },
      {
        type:"collapse",
        name:"Brands",
        key:"brands",
        icon:<Icon fontSize='small'>branding_watermark</Icon>,
        collapse: [
          {
            type: "route",
            name: "Create",
            icon: "C",
            roles:['super-admin','employ'],
            key: "create",
            route: "/create-brand",
            component: <OrdersPage />,
          },
          {
            type: "route",
            name: "Browse",
            icon: "B",
            key: "Browse",
            route: "/browse-brand",
            component: <OrdersPage />,
          },
        ],
      },
      {
        type:"collapse",
        name:"Gift-Cards",
        roles:['super-admin'],
        key:"GiftCards",
        icon:<Icon fontSize='small'>gift</Icon>,
        collapse: [
          {
            type: "route",
            name: "Create",
            icon: "C",
            key: "create",
            route: "/create-gift",
            component: <OrdersPage />,
          },
          {
            type: "route",
            name: "Browse",
            icon: "B",
            key: "Browse",
            route: "/browse-gift",
            component: <OrdersPage />,
          },
        ],
      },
    ],
  },
  {
    type: "collapse",
    name: "Tables",
    key: "tables",
    role:"super-admin|employ|author",
    icon: <Icon fontSize="small">table_view</Icon>,
    route: "/tables",
    component: <Tables />,
  },
  {
    type: "collapse",
    name: "Billing",
    key: "billing",
    icon: <Icon fontSize="small">receipt_long</Icon>,
    route: "/billing",
    component: <Billing />,
  },
  {
    type: "collapse",
    name: "RTL",
    key: "rtl",
    icon: <Icon fontSize="small">format_textdirection_r_to_l</Icon>,
    route: "/rtl",
    component: <RTL />,
  },
  {
    type: "collapse",
    name: "Notifications",
    key: "notifications",
    icon: <Icon fontSize="small">notifications</Icon>,
    route: "/notifications",
    component: <Notifications />,
  },

  {
    type: "collapse",
    name: "Sign In",
    key: "sign-in",
    roles:["author"],
    icon: <Icon fontSize="small">login</Icon>,
    route: "/authentication/sign-in",
    component: <SignIn />,
  },
  {
    type: "examples",
    name: "User Profile",
    key: "user-profile",
    icon: <Icon fontSize="small">person</Icon>,
    route: "/user-profile",
    component: <UserProfile />,
  },
  {
    type: "examples",
    name: "User Management",
    roles:['super-admin'],
    key: "user-management",
    icon: <Icon fontSize="small">list</Icon>,
    route: "/user-management",
    component: <UserManagement />,
  },
  {
    type: "collapse",
    name: "Sign Up",
    key: "sign-up",
    icon: <Icon fontSize="small">assignment</Icon>,
    route: "/authentication/sign-up",
    component: <SignUp />,
  },
  {
    type: "auth",
    name: "Login",
    key: "login",
    icon: <Icon fontSize="small">login</Icon>,
    route: "/auth/login",
    component: <Login />,
  },
  {
    type: "auth",
    name: "Register",
    roles:['super-admin','employ'],
    key: "register",
    icon: <Icon fontSize="small">register</Icon>,
    route: "/auth/register",
    component: <Register />,
  },
  {
    type: "auth",
    name: "Forgot Password",
    key: "forgot-password",
    icon: <Icon fontSize="small">assignment</Icon>,
    route: "/auth/forgot-password",
    component: <ForgotPassword />,
  },
  {
    type: "auth",
    name: "Reset Password",
    key: "reset-password",
    icon: <Icon fontSize="small">assignment</Icon>,
    route: "/auth/reset-password",
    component: <ResetPassword />,
  },

  {
    type:"collapse",
    roles:['super-admin'],
    name:"Payments",
    key:"payments",
    icon:<Icon fontSize='small'>payment</Icon>,
    collapse: [
      {
        type: "route",
        name: "Failed-Payments",
        icon: "F",
        key: "FailedPayments",
        route: "/failed-payments",
        component: <OrdersPage />,
      },
      {
        type: "route",
        name: "All-Payments",
        icon: "A",
        key: "AllPayments",
        route: "/all-payments",
        component: <OrdersPage />,
      },
    ],
  },
  {
    type:"collapse",
    name:"Comments",
    roles:['super-admin','employ','author'],
    key:"comments",
    icon:<Icon fontSize='small'>comment</Icon>,
    collapse: [
      {
        type: "route",
        name: "All-reviews",
        icon: "A",
        key: "AllReviews",
        route: "/all-reviews",
        component: <OrdersPage />,
      },
      {
        type: "route",
        name: "Not-Approved",
        icon: "N",
        key: "NotApproved",
        route: "/not-approved",
        component: <OrdersPage />,
      },
    ],
  },
  {
    type:"collapse",
    name:"Users",
    key:"users",
    icon:<Icon fontSize='small'>person</Icon>,
    collapse: [
      {
        type: "route",
        name: "All-Users",
        roles:['author','super-admin','employ'],
        icon: "A",
        key: "AllUsers",
        route: "/all-Users",
        component: <OrdersPage />,
      },
      {
        type: "route",
        name: "New-Users",
        roles:['super-admin','employ'],
        icon: "N",
        key: "NewUsers",
        route: "/new-users",
        component: <OrdersPage />,
      },
    ],
  },
  {
    type:"collapse",
    name:"Roles",
    roles:['super-admin'],
    key:"roles",
    icon:<Icon fontSize='small'>security</Icon>,
    collapse: [
      {
        type: "route",
        name: "Role-List",
        icon: "R",
        key: "RoleList",
        route: "/role-list",
        component: <OrdersPage />,
      },
      {
        type: "route",
        name: "New-Role",
        icon: "N",
        key: "NewRole",
        route: "/new-role",
        component: <OrdersPage />,
      },
    ],
  },
  {
    type: "collapse",
    name: "Setting",
    roles:['super-admin'],
    key: "setting",
    icon: <Icon fontSize="small">settings</Icon>,
    route: "/setting",
    component: <Settings />,
  },






];

export default routes;
