import Vue from "vue";
import VueRouter from "vue-router";

import AppLayout from "./layouts/app";
import IndexPage from "./pages/index";
import ClubsIdLayout from "./layouts/clubs/_id";
import ClubsIdIndexPage from "./pages/clubs/_id/index";
import EditPage from "./pages/edit";
import ClubsIdEditPage from "./pages/clubs/_id/edit";
import ClubsIdMembersIndexPage from "./pages/clubs/_id/members/index";
import ClubsNewPage from "./pages/clubs/new";
import ClubsIdEventsNewPage from "./pages/clubs/_id/events/new";
import ClubsIdEventsIdEditPage from "./pages/clubs/_id/events/_id/edit";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: AppLayout,
    children: [
      {
        path: "",
        component: IndexPage
      },
      {
        path: "edit",
        component: EditPage
      },
      {
        path: "clubs/new",
        component: ClubsNewPage
      }
    ]
  },
  {
    path: "/clubs/:club_id",
    component: ClubsIdLayout,
    children: [
      {
        path: "",
        component: ClubsIdIndexPage
      },
      {
        path: "edit",
        component: ClubsIdEditPage
      },
      {
        path: "members",
        component: ClubsIdMembersIndexPage
      },
      {
        path: "events/new",
        component: ClubsIdEventsNewPage
      },
      {
        path: "events/:event_id/edit",
        component: ClubsIdEventsIdEditPage
      }
    ]
  }
];

const router = new VueRouter({
  mode: "history",
  routes
});

export default router;
