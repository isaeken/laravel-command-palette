import ReactDOM from 'react-dom';
import CommandPalette from "./Components/CommandPalette";

document.addEventListener("DOMContentLoaded", () => {
  ReactDOM.render(
    <CommandPalette/>,
    document.getElementById("laravel-command-palette")
  );
});
