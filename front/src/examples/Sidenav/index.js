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

import { useContext, useEffect, useState } from "react";
import { useLocation, NavLink } from "react-router-dom";
import PropTypes from "prop-types";

// @mui material components
import List from "@mui/material/List";
import Divider from "@mui/material/Divider";
import Link from "@mui/material/Link";
import Icon from "@mui/material/Icon";

// Material Dashboard 2 React components
import MDBox from "components/MDBox";
import MDTypography from "components/MDTypography";
import MDButton from "components/MDButton";

// Material Dashboard 2 React example components
import SidenavCollapse from "examples/Sidenav/SidenavCollapse";

// Custom styles for the Sidenav
import SidenavRoot from "examples/Sidenav/SidenavRoot";
import sidenavLogoLabel from "examples/Sidenav/styles/sidenav";
// Material Dashboard 2 React context
import {
  useMaterialUIController,
  setMiniSidenav,
  setTransparentSidenav,
  setWhiteSidenav,
 AuthContext,
} from "context";

function Sidenav({ color, brand, brandName, routes, ...rest }) {
  // const { user, roles } = useContext(AuthContext);
  const [controller, dispatch] = useMaterialUIController();
  const { miniSidenav, transparentSidenav, whiteSidenav, darkMode, sidenavColor } = controller;
  const location = useLocation();
  const collapseName = location.pathname.replace("/", "");
  const { roles } =useContext(AuthContext);
  const [openCollapse, setOpenCollapse] = useState({});

  const toggleCollapse = (key, isRoot = false) => {
    if (isRoot) {
      setOpenCollapse((prev) => {
        const newState = {};
        newState[key] = !prev[key];
        // بقیه سطح دوم و سوم‌ها دست نخورده باقی می‌مانند
        Object.keys(prev).forEach((k) => {
          if (!k.includes("-")) newState[k] = newState[k] || false;
          else newState[k] = prev[k]; // فرعی‌ها بدون تغییر
        });
        return newState;
      });
    } else {
      setOpenCollapse((prev) => ({ ...prev, [key]: !prev[key] }));
    }
  };

  let textColor = "white";
  if (transparentSidenav || (whiteSidenav && !darkMode)) textColor = "dark";
  else if (whiteSidenav && darkMode) textColor = "inherit";

  const closeSidenav = () => setMiniSidenav(dispatch, true);

  useEffect(() => {
    function handleMiniSidenav() {
      setMiniSidenav(dispatch, window.innerWidth < 1200);
      setTransparentSidenav(dispatch, window.innerWidth < 1200 ? false : transparentSidenav);
      setWhiteSidenav(dispatch, window.innerWidth < 1200 ? false : whiteSidenav);
    }

    window.addEventListener("resize", handleMiniSidenav);
    handleMiniSidenav();
    return () => window.removeEventListener("resize", handleMiniSidenav);
  }, [dispatch, transparentSidenav, whiteSidenav]);

  // Recursive function to render all sidenav items
  const renderSidenavItems = (items, parentKey = "") =>
    items.map(({ type, name, icon, key, route, collapse, href, title, roles: allowRoles }) => {
      if (allowRoles && !roles.some(r => allowRoles.includes(r))) {
        return null;
      }
      const uniqueKey = parentKey ? `${parentKey}-${key}` : key;
      if (type === "title") {
        return (
          <MDTypography
            key={uniqueKey}
            color={textColor}
            display="block"
            variant="caption"
            fontWeight="bold"
            textTransform="uppercase"
            pl={3}
            mt={2}
            mb={1}
            ml={1}
          >
            {title}
          </MDTypography>
        );
      }

      if (type === "divider") {
        return (
          <Divider
            key={uniqueKey}
            light={
              (!darkMode && !whiteSidenav && !transparentSidenav) ||
              (darkMode && !transparentSidenav && whiteSidenav)
            }
          />
        );
      }

      if (type === "collapse" || type === "route" || type === "href") {
        const isActive =
          collapse?.some((sub) => sub.key === collapseName) ||
          key === collapseName ||
          route === location.pathname;

        const hasChild = Boolean(collapse);

        const itemContent = (
          <SidenavCollapse
            name={name}
            icon={typeof icon === "string" ? <Icon sx={{ color: "#fff" }}>{icon}</Icon> : icon}
            active={isActive}
            onClick={() => toggleCollapse(uniqueKey, !parentKey)}
            open={openCollapse[uniqueKey]}
            hasChild={hasChild}
          />
        );

        let wrapper;
        if (href) {
          wrapper = (
            <Link
              key={uniqueKey}
              href={href}
              target="_blank"
              rel="noreferrer"
              sx={{ textDecoration: "none" }}
            >
              {itemContent}
            </Link>
          );
        } else if (route) {
          wrapper = (
            <NavLink key={uniqueKey} to={route} style={{ textDecoration: "none" }}>
              {itemContent}
            </NavLink>
          );
        } else {
          wrapper = <MDBox key={uniqueKey}>{itemContent}</MDBox>;
        }

        return (
          <MDBox key={uniqueKey}>
            {wrapper}
            {collapse && openCollapse[uniqueKey] && (
              <MDBox sx={{ pl: 3 }}>{renderSidenavItems(collapse, uniqueKey)}</MDBox>
            )}
          </MDBox>
        );
      }

      return null;
    });

  return (
    <SidenavRoot
      {...rest}
      variant="permanent"
      ownerState={{ transparentSidenav, whiteSidenav, miniSidenav, darkMode }}
    >
      <MDBox pt={3} pb={1} px={4} textAlign="center">
        <MDBox
          display={{ xs: "block", xl: "none" }}
          position="absolute"
          top={0}
          right={0}
          p={1.625}
          onClick={closeSidenav}
          sx={{ cursor: "pointer" }}
        >
          <MDTypography variant="h6" color="secondary">
            <Icon sx={{ fontWeight: "bold" }}>close</Icon>
          </MDTypography>
        </MDBox>
        <MDBox component={NavLink} to="/" display="flex" alignItems="center">
          {brand && <MDBox component="img" src={brand} alt="Brand" width="2rem" />}
          <MDBox
            width={!brandName && "100%"}
            sx={(theme) => sidenavLogoLabel(theme, { miniSidenav })}
          >
            <MDTypography component="h6" variant="button" fontWeight="medium" color={textColor}>
              {brandName}
            </MDTypography>
          </MDBox>
        </MDBox>
      </MDBox>

      <Divider
        light={
          (!darkMode && !whiteSidenav && !transparentSidenav) ||
          (darkMode && !transparentSidenav && whiteSidenav)
        }
      />

      <List>{renderSidenavItems(routes)}</List>

      <MDBox p={2} mt="auto">
        <MDButton
          component="a"
          href="https://www.creative-tim.com/product/material-dashboard-pro-react-laravel"
          target="_blank"
          rel="noreferrer"
          variant="gradient"
          color={sidenavColor}
          fullWidth
        >
          upgrade to pro
        </MDButton>
      </MDBox>
    </SidenavRoot>
  );
}

Sidenav.defaultProps = {
  color: "info",
  brand: "",
};

Sidenav.propTypes = {
  color: PropTypes.oneOf(["primary", "secondary", "info", "success", "warning", "error", "dark"]),
  brand: PropTypes.string,
  brandName: PropTypes.string.isRequired,
  routes: PropTypes.arrayOf(PropTypes.object).isRequired,
};

export default Sidenav;
