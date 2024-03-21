import { Navigate, Routes, createBrowserRouter } from "react-router-dom";
import Login from "./views/Login.jsx";
import Signup from "./views/Signup.jsx";
import Users from "./views/Users.jsx";
import NotFound from "./views/NotFound.jsx";
import DefaultLayout from "./components/DefaultLayout.jsx";
import GuestLayout from "./components/GuestLayout.jsx";
import Dashboard from "./views/Dashboard.jsx";
import UserForm from "./views/UserForm.jsx";
import GuestDashboard from "./views/GuestDashboard.jsx";
import Repositories from "./views/Repositories.jsx";
import RepositoryForm from "./views/RepositoryForm.jsx";
import PullRequests from "./views/PullRequests.jsx";

const router = createBrowserRouter([
  {
    path: "/",
    element: <DefaultLayout />,
    children: [
      {
        path: "/",
        element: <Navigate to="/repositories" />,
      },
      {
        path: "/dashboard",
        element: <Dashboard />,
      },
      {
        path: "/users",
        element: <Users />,
      },
      {
        path: "/repositories",
        element: <Repositories />,
      },
      {
        path: "/pullrequests/:owner/:repo_name",
        element: <PullRequests />,
      },
      {
        path: "/repositories/new",
        element: <RepositoryForm key="repositoryCreate" />,
      },
      {
        path: "/users/new",
        element: <UserForm key="userCreate" />,
      },
      {
        path: "/users/:id",
        element: <UserForm key="userUpdate" />,
      },
    ],
  },
  {
    path: "/",
    element: <GuestLayout />,
    children: [
      // {
      //   path: "/",
      //   element: <Navigate to="/guestDashboard" />,
      // },
      {
        path: "/guestDashboard",
        element: <GuestDashboard />,
      },
      {
        path: "/login",
        element: <Login />,
      },
      {
        path: "/signup",
        element: <Signup />,
      },
    ],
  },

  {
    path: "*",
    element: <NotFound />,
  },
]);

export default router;
