import { useEffect, useState } from "react";
// import axiosClient from "../axios-client.js";
import axiosGuest from "../axios-guest.js";
import { Link, Navigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider.jsx";
import React from "react";

export default function Repositories() {
  const [guestRepositories, setRepositories] = useState([]);
  const [links, setLinks] = useState([]);
  const [loading, setLoading] = useState(false);
  // const { setNotification, token } = useStateContext();

  useEffect(() => {
    getRepositories();
  }, []);

  const getRepositories = (url) => {
    setLoading(true);
    axiosGuest
      .get(url ?? "/guestRepositories")
      .then(({ data }) => {
        setLoading(false);
        //debugger;
        console.log(data);
        setRepositories(data.data);
        setLinks(data.meta.links);
      })
      .catch(() => {
        setLoading(false);
      });
  };

  return (
    <div>
      <div
        style={{
          display: "flex",
          justifyContent: "space-between",
          alignItems: "center",
        }}
      >
        <h1>Repositories</h1>
        <p className="message">
          Already Registered?{" "}
          <Link className="btn-edit" to="/login">
            Sign in
          </Link>
        </p>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
            <tr>
              <th>username/repository_name</th>
              <th>number of watchers</th>
              <th>date and time of creation</th>
            </tr>
          </thead>
          {loading && (
            <tbody>
              <tr>
                <td colSpan="5" className="text-center">
                  Loading...
                </td>
              </tr>
            </tbody>
          )}
          {!loading && (
            <tbody>
              {guestRepositories?.map((u) => (
                <tr key={u.id}>
                  <td>
                    {u.owner}/{u.repo_name}
                  </td>
                  <td>{u.no_of_watchers}</td>
                  <td>{u.created_at}</td>
                </tr>
              ))}
            </tbody>
          )}
        </table>
      </div>

      {links?.map((link) =>
        link.active === "false" ? (
          <button
            disabled
            className="btn"
            onClick={() => getRepositories(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        ) : (
          <button
            className="btn-edit"
            onClick={() => getRepositories(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        )
      )}
    </div>
  );
}
