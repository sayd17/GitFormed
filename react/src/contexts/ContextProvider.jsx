import { createContext, useContext, useState } from "react";

const StateContext = createContext({
  user: null,
  token: null,
  loggedInUser: null,
  setUser: () => {},
  setToken: () => {},
  setNotification: () => {},
  setLoggedInUser: () => {},
});

export const ContextProvider = ({ children }) => {
  const [user, setUser] = useState({});
  // const [token, _setToken] = useState(null);
  // const [token, _setToken] = useState(null);
  const [notification, _setNotification] = useState("");
  // const [token, _setToken] = useState(123);
  const [token, _setToken] = useState(localStorage.getItem("ACCESS_TOKEN"));

  const [loggedInUser, setLoggedInUser] = useState(null);

  const setNotification = (message) => {
    _setNotification(message);
    setTimeout(() => {
      _setNotification("");
    }, 5000);
  };

  const setToken = (token) => {
    _setToken(token);
    if (token) {
      localStorage.setItem("ACCESS_TOKEN", token);
    } else {
      localStorage.removeItem("ACCESS_TOKEN");
    }
  };
  // console.log(token);
  // console.log(localStorage);
  // debugger;
  return (
    <StateContext.Provider
      value={{
        user,
        token,
        loggedInUser,
        setUser,
        setToken,
        notification,
        setNotification,
        setLoggedInUser,
      }}
    >
      {children}
    </StateContext.Provider>
  );
};

export const useStateContext = () => useContext(StateContext);
