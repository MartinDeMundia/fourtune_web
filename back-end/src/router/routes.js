import DashboardLayout from "@/pages/Dashboard/Layout/DashboardLayout.vue";
import AuthLayout from "@/pages/Dashboard/Pages/AuthLayout.vue";

// Dashboard pages
import Dashboard from "@/pages/Dashboard/Dashboard.vue";
import Home from "@/pages/Dashboard/Main/Home.vue";
import Profile from "@/pages/Dashboard/Main/Profile.vue";

import TokenTransfers from "@/pages/Dashboard/Main/TokenTransfers.vue";
import TokenPurchases from "@/pages/Dashboard/Main/TokenPurchases.vue";
import CoinsEarned from "@/pages/Dashboard/Main/CoinsEarned.vue";
import SetToken from "@/pages/Dashboard/Main/SetToken.vue";
import PostEvent from "@/pages/Dashboard/Main/PostEvent.vue";
import ListEvents from "@/pages/Dashboard/Main/ListEvent.vue";

// Profile
import UserProfile from "@/pages/Dashboard/Main/UserProfile.vue";

// User Management
import ListUserPage from "@/pages/Dashboard/Main/ListUserPage.vue";

// Pages
import RtlSupport from "@/pages/Dashboard/Pages/RtlSupport.vue";
import Login from "@/pages/Dashboard/Pages/Login.vue";
import Register from "@/pages/Dashboard/Pages/Register.vue";

// Components pages
import Notifications from "@/pages/Dashboard/Components/Notifications.vue";
import Icons from "@/pages/Dashboard/Components/Icons.vue";
import Typography from "@/pages/Dashboard/Components/Typography.vue";

// TableList pages
import RegularTables from "@/pages/Dashboard/Tables/RegularTables.vue";

// Maps pages
import FullScreenMap from "@/pages/Dashboard/Maps/FullScreenMap.vue";

//import middleware
import auth from "@/middleware/auth";
import guest from "@/middleware/guest";

let componentsMenu = {
  path: "/components",
  component: DashboardLayout,
  redirect: "/components/notification",
  name: "Components",
  children: [
    {
      path: "table",
      name: "Table",
      components: { default: RegularTables },
      meta: { middleware: auth }
    },
    {
      path: "typography",
      name: "Typography",
      components: { default: Typography },
      meta: { middleware: auth }
    },
    {
      path: "icons",
      name: "Icons",
      components: { default: Icons },
      meta: { middleware: auth }
    },
    {
      path: "maps",
      name: "Maps",
      meta: {
        hideContent: true,
        hideFooter: true,
        navbarAbsolute: true,
        middleware: auth
      },
      components: { default: FullScreenMap }
    },
    {
      path: "notifications",
      name: "Notifications",
      components: { default: Notifications },
      meta: { middleware: auth }
    },
    {
      path: "rtl",
      name: "وحة القيادة",
      meta: {
        rtlActive: true,
        middleware: auth
      },
      components: { default: RtlSupport }
    }
  ]
};



let mainMenu = {
  path: "/main",
  component: DashboardLayout,
  name: "Main",
  children: [
    {
      path: "token-purchases",
      name: "Token Purchases",
      components: { default: TokenPurchases },
      meta: { middleware: auth }
    },
    {
      path: "coins-earned",
      name: "Coins Earned",
      components: { default: CoinsEarned },
      meta: { middleware: auth }
    },
    {
      path: "set-token",
      name: "Fourtune Token Price",
      components: { default: SetToken },
      meta: { middleware: auth }
    },
    {
      path: "token-transfer",
      name: "Fourtune Token Transfer",
      components: { default: TokenTransfers },
      meta: { middleware: auth }
    },
    {
      path: "post-event",
      name: "Post Event",
      components: { default: PostEvent },
      meta: { middleware: auth }
    },
    {
      path: "list-events",
      name: "List Events",
      components: { default: ListEvents },
      meta: { middleware: auth }
    }
  ]
};



let usersMenu = {
  path: "/main",
  component: DashboardLayout,
  name: "UserMenus",
  children: [
    {
      path: "user-profile",
      name: "User Profile",
      components: { default: UserProfile },
      meta: { middleware: auth }
    },
    {
      path: "list-users",
      name: "List Users",
      components: { default: ListUserPage },
      meta: { middleware: auth }
    }
  ]
};

let authPages = {
  path: "/",
  component: AuthLayout,
  name: "Authentication",
  children: [
    {
      path: "/login",
      name: "Login",
      component: Login,
      meta: { middleware: guest }
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
      meta: { middleware: guest }
    }
  ]
};








const routes = [
 /* {
    path: "/",
    redirect: "/admin",
    name: "Home"
  },*/
  {
    path: "/",
    component: Home,
    meta: { middleware: auth },
    children: [
      {
        path: "home",
        name: "Home",
        components: { default: Home },
        meta: { middleware: auth }
      }
    ]
  },
  {
    path: "/admin",
    component: DashboardLayout,
    meta: { middleware: auth },
    children: [
      {
        path: "",
        name: "Dashboard",
        components: { default: Dashboard },
        meta: { middleware: auth }
      }
    ]
  },

  {
    path: "/profile",
    component: Profile,
    meta: { middleware: auth },
    children: [
      {
        path: "",
        name: "Profile",
        components: { default: Profile },
        meta: { middleware: auth }
      }
    ]
  },

  mainMenu,
  componentsMenu,
  usersMenu,
  authPages
];






/*const routes = [
  {
    path: "/",
    redirect: "/dashboard",
    name: "Home"
  },
  {
    path: "/",
    component: DashboardLayout,
    meta: { middleware: auth },
    children: [
      {
        path: "dashboard",
        name: "Dashboard",
        components: { default: Dashboard },
        meta: { middleware: auth }
      }
    ]
  },
  mainMenu,
  componentsMenu,
  usersMenu,
  authPages
];*/

export default routes;
