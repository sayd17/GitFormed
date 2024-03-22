import { useNavigate, useParams } from "react-router-dom";
import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { useStateContext } from "../contexts/ContextProvider.jsx";

export default function PullRequest() {
  const navigate = useNavigate();
  const { user, setNotification } = useStateContext();
  let { owner, repo_name } = useParams();
  const [pullRequests, setPullRequests] = useState([]);

  const [pullRequest, setPullRequest] = useState({
    owner: owner,
    repo_name: repo_name,
    title: "",
  });
  const [errors, setErrors] = useState(null);
  const [loading, setLoading] = useState(false);
  const [links, setLinks] = useState([]);

  useEffect(() => {
    getPullRequests();
  }, []);

  const getPullRequests = (url) => {
    setLoading(true);
    axiosClient
      .get(url ?? "/getpullrequests")
      .then(({ data }) => {
        setLoading(false);
        // debugger;
        console.log(data.data);
        setPullRequests(data.data);
        setLinks(data.meta.links);
      })
      .catch(() => {
        setLoading(false);
      });
  };

  const onSubmit = (ev) => {
    ev.preventDefault();

    axiosClient
      .post("/pullrequests", pullRequest)
      .then(() => {
        setNotification("PullRequest was successfully created");
        navigate(`/pullrequests/${owner}/${repo_name}`);
      })
      .catch((err) => {
        const response = err.response;
        if (response && response.status === 422) {
          setErrors(response.data.errors);
        }
      });
  };

  return (
    <>
      <h1> Pull Request </h1>
      <div className="card animated fadeInDown">
        {loading && <div className="text-center">Loading...</div>}
        {errors && (
          <div className="alert">
            {Object.keys(errors).map((key) => (
              <p key={key}>{errors[key][0]}</p>
            ))}
          </div>
        )}
        {/*  Submit form */}
        {!loading && (
          <form onSubmit={onSubmit}>
            <input
              value={pullRequest.title}
              onChange={(ev) =>
                setPullRequest({
                  ...pullRequest,
                  title: ev.target.value,
                })
              }
              placeholder="PR title"
            />

            <button className="btn">Create</button>
          </form>
        )}

        {/* Fetch Pull Requests  */}
        {
          <div className="card animated fadeInDown">
            <table>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Time of creation</th>
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
                  {pullRequests?.map((u) => (
                    <tr key={u.id}>
                      <td>{u.id}</td>
                      <td>{u.title}</td>
                      <td>{u.created_at}</td>
                    </tr>
                  ))}
                </tbody>
              )}
            </table>
          </div>
        }
        {links?.map((link) =>
          link.active === "false" ? (
            <button
              disabled
              className="btn-edit"
              onClick={() => getPullRequests(link.url)}
              dangerouslySetInnerHTML={{ __html: link?.label }}
            ></button>
          ) : (
            <button
              className="btn-edit"
              onClick={() => getPullRequests(link.url)}
              dangerouslySetInnerHTML={{ __html: link?.label }}
            ></button>
          )
        )}
      </div>
    </>
  );
}
