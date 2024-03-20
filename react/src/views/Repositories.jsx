import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { Link, Navigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider.jsx";
import React from "react";

export default function Repositories() {
  const [repositories, setRepositories] = useState([]);
  const [links, setLinks] = useState([]);
  const [loading, setLoading] = useState(false);
  const { setNotification, token } = useStateContext();
  const [order, setOrder] = useState("DESC");

  // const sorting = (col) => {
  //   if (order === "ASC") {
  //     setOrder("DESC");
  //     // .get("/repositories?sort_by=" + col + "&order_by=asc")
  //     axiosClient
  //       .get("/repositories?sort_by=asc(" + col + ")")
  //       .then(({ data }) => {
  //         console.log(col);
  //         console.log("asc");
  //         setRepositories(data.data);
  //         console.log(repositories);
  //         setLinks(data.meta.links);
  //       })
  //       .catch(() => {});
  //   }

  //   if (order === "DESC") {
  //     setOrder("ASC");
  //     axiosClient
  //       .get("/repositories?sort_by=" + col + "&order_by=desc")
  //       .then(({ data }) => {
  //         // console.log(col);
  //         console.log("desc");

  //         setRepositories(data.data);
  //         // console.log(repositories);
  //         setLinks(data.meta.links);
  //       })
  //       .catch(() => {});
  //   }
  // };

  useEffect(() => {
    getRepositories();
  }, []);

  const getRepositories = (url) => {
    setLoading(true);
    axiosClient
      .get(url ?? "/repositories")
      .then(({ data }) => {
        setLoading(false);
        //debugger;
        // console.log(data);
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
        <Link className="btn-add" to="/repositories/new">
          Create Repository
        </Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
            <tr>
              <th onClick={() => sorting("repo_name")}>
                username/repository_name
              </th>
              <th onClick={() => sorting("no_of_watchers")}>
                number of watchers
              </th>
              <th onClick={() => sorting("created_at")}>
                date and time of creation
              </th>
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
              {repositories?.map((u) => (
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
            className="btn-edit"
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
