import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { Link, Navigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider.jsx";
import React from "react";

export default function Repositories() {
  const [repositories, setRepositories] = useState([]);
  const [links, setLinks] = useState([]);
  const [loading, setLoading] = useState(false);
  const { user, setNotification, token } = useStateContext();

  useEffect(() => {
    getRepositories();
  }, []);

  const watching = (owner, repo_name) => {
    const payload = {
      repo_name: repo_name,
      owner: owner,
      username: user.username,
    };
    console.log(payload);
    // debugger;
    axiosClient
      .post("/watching", payload)
      .then(({ data }) => {
        console.log(data);
        setNotification("Watch Successful");
      })
      .catch((err) => {
        // console.log(err);
        const response = err.response;
        if (response && response.status === 422) {
          // setErrors(response.data.errors);
        }
      });
  };

  const sorting = (col) => {
    if (col == "owner") {
      // sort by owner
      setLoading(true);
      axiosClient
        .get("/sortRepoByOwner")
        .then(({ data }) => {
          setLoading(false);
          // debugger;
          console.log(data.data);
          setRepositories(data.data);
          setLinks(data.meta.links);
        })
        .catch(() => {
          setLoading(false);
        });
    } else if (col == "no_of_watchers") {
      // sort by repo_name
      setLoading(true);
      axiosClient
        .get("/sortRepoByWatchers")
        .then(({ data }) => {
          setLoading(false);
          // debugger;
          // console.log(data.data);
          setRepositories(data.data);
          setLinks(data.meta.links);
        })
        .catch(() => {
          setLoading(false);
        });
    } else if (col == "created_at") {
      // sort by created_at
      setLoading(true);
      axiosClient
        .get("/sortRepoByLatest")
        .then(({ data }) => {
          setLoading(false);
          // debugger;
          // console.log(data.data);
          setRepositories(data.data);
          setLinks(data.meta.links);
        })
        .catch(() => {
          setLoading(false);
        });
    }
  };

  const getRepositories = (url) => {
    setLoading(true);
    axiosClient
      .get(url ?? "/repositories")
      .then(({ data }) => {
        setLoading(false);
        // debugger;
        // console.log(data.data);
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
              <th onClick={() => sorting("owner")}>username/repository_name</th>
              <th onClick={() => sorting("no_of_watchers")}>
                number of watchers
              </th>
              <th onClick={() => sorting("created_at")}>
                date and time of creation
              </th>
              <th>Actions</th>
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
                <tr>
                  <td>
                    {u.owner}/{u.repo_name}
                  </td>
                  <td key={u.no_of_watchers}>{u.no_of_watchers}</td>
                  <td key={u.created_at}>{u.created_at}</td>
                  <td>
                    <Link
                      className="btn-edit"
                      to={`/pullrequests/${u.owner}/${u.repo_name}`}
                    >
                      Pull Requests
                    </Link>
                    &nbsp;
                    <button
                      className="btn-edit"
                      onClick={() => watching(u.owner, u.repo_name)}
                    >
                      Watch
                    </button>
                  </td>
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
