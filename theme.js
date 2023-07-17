
      const element = document.body;
      function getCookie(name) {
        const cookies = decodeURIComponent(document.cookie).split("; ");
        for (let i = 0; i < cookies.length; i++) {
          const parts = cookies[i].split("=");
          if (parts[0] === name) {
            return parts[1];
          }
        }
        return null;
      }

      function handleClick() {
        var isDark = getCookie("mode");
        if (isDark == "false") {
          element.classList.add("dark-mode");
          element.classList.remove("light-mode");
          isDark = "true";
          document.cookie = "mode=" + encodeURIComponent(isDark) + ";path=/";
        } else {
          element.classList.add("light-mode");
          element.classList.remove("dark-mode");
          isDark = "false";
          document.cookie = "mode=" + encodeURIComponent(isDark) + ";path=/";
        }
      }
      
      window.onload = function() {
        var isLight = getCookie("mode");
        if (isLight == "true") {
          element.classList.add("dark-mode");
          element.classList.remove("light-mode");
        } else {
          element.classList.add("light-mode");
          element.classList.remove("dark-mode");
        }
      }
