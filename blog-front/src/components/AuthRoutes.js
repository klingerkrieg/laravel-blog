import { createContext, useContext, useState } from "react";
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link,
    Navigate,
    useNavigate,
    useLocation
  } from "react-router-dom";

const fakeAuth = {
    isAuthenticated: false,
    signin(cb) {
      fakeAuth.isAuthenticated = true;
      setTimeout(cb, 100); // fake async
    },
    signout(cb) {
      fakeAuth.isAuthenticated = false;
      setTimeout(cb, 100);
    }
};

function useAuth() {
    return useContext(authContext);
}

const authContext = createContext();

export function useProvideAuth() {
    const [user, setUser] = useState(null);
  
    const signin = cb => {
      return fakeAuth.signin(() => {
        setUser("user");
        cb();
      });
    };
  
    const signout = cb => {
      return fakeAuth.signout(() => {
        setUser(null);
        cb();
      });
    };
  
    return {
      user,
      signin,
      signout
    };
  }


export function AuthButton() {
    let navigate = useNavigate();
    let auth = useAuth();
  
    return auth.user ? (
      <p>
        Welcome!{" "}
        <button
          onClick={() => {
            auth.signout(() => navigate("/"));
          }}
        >
          Sign out
        </button>
      </p>
    ) : (
      <p>You are not logged in.</p>
    );
  }
  
export function ProvideAuth({ children }) {
    const auth = useProvideAuth();
    return (
      <authContext.Provider value={auth}>
        {children}
      </authContext.Provider>
    );
  }
  
  // A wrapper for <Route> that redirects to the login
  // screen if you're not yet authenticated.
export  function PrivateRoute({ children, ...rest }) {
    let auth = useAuth();
    return (
      <Route
        {...rest}
        render={({ location }) =>
          auth.user ? (
            children
          ) : (
            <Navigate
              to={{
                pathname: "/login",
                state: { from: location }
              }}
            />
          )
        }
      />
    );
  }
  