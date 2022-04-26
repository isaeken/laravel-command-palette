import React, {createRef} from 'react';
import {Backdrop, Modal} from "@mui/material";

export default class Container extends React.Component {
  input = createRef();

  constructor(props) {
    super(props);

    this.state = {
      open: false,
      placeholder: props.placeholder ?? 'Search or jump to...',
      tips: {
        enabled: true,
        texts: [],
      },
      selected: -1,
    };
  }

  componentDidMount() {
    document.onkeydown = (event) => {
      if (event.ctrlKey && event.code === "KeyK") {
        this.open();
        event.preventDefault();
        return true;
      } else if (event.code === "Escape") {
        this.close();
        event.preventDefault();
        return true;
      } else if (event.code === "ArrowDown") {
        this.setState({selected: this.state.selected + 1});
        this.autoFocus();
      } else if (event.code === "ArrowUp") {
        if (!(this.state.selected < 0)) {
          this.setState({selected: this.state.selected - 1});
        } else {
          this.autoFocus();
        }
      } else {
        console.log(event)
      }
    };

    this.autoFocus();
  }

  open = () => {
    this.setState({open: true});
    setTimeout(() => {
      this.autoFocus();
    }, 150);
  };

  close = () => {
    this.setState({open: false});
  };

  tips = () => {
    if (this.state.tips.enabled) {
      return (
        <div className="x-w-full x-pt-4 x-pb-2 x-px-3 x-text-sm x-tracking-wide x-box-border">
          <b className="x-mr-1">Tip:</b>
          <span>just testing...</span>
        </div>
      );
    }
  };

  items = () => {
    let items = [];

    for (let i = 0; i < 100; i++) {
      items.push(i);
    }

    return items.map((value, index, array) => {
      return (
        <div
          className={
            this.state.selected === index ?
              "x-select-none x-cursor-pointer x-flex x-text-sm x-px-4 x-py-4 x-block x-m-2 x-rounded-lg x-bg-indigo-600 x-text-white" :
              "x-select-none x-cursor-pointer x-flex x-text-sm x-px-4 x-py-4 x-block x-m-2 x-rounded-lg x-bg-white hover:x-text-white x-bg-opacity-20 hover:x-bg-indigo-600"
          }>
          <div className="x-w-full">
            Item {value}
          </div>
          <div className="x-text-right x-w-24 text-xs x-opacity-50">
            Jump to...
          </div>
        </div>
      );
    });
  };

  autoFocus = () => {
    if (this.state.selected === -1 && this.input.current != null) {
      this.input.current.focus();
    }
  };

  render() {
    return (
      <div style={{
        zIndex: 9999999,
      }}>
        <Modal
          open={this.state.open}
          onClose={this.close}
          aria-labelledby="modal-modal-title"
          aria-describedby="modal-modal-description"
        >
          <div
            className="x-font-roboto x-shadow-2xl x-fixed x-w-full x-max-w-2xl x-top-1/2 x-left-1/2 x-transform -x-translate-x-1/2 -x-translate-y-1/2 x-bg-white x-bg-opacity-75 x-backdrop-blur-md x-rounded-xl x-outline-none">
            <input
              ref={this.input}
              placeholder={this.state.placeholder}
              className="x-font-roboto x-text-xl x-box-border x-py-4 x-px-4 x-block x-outline-none x-border-0 x-border-b x-border-gray-300 x-rounded-t-xl x-bg-transparent x-w-full"/>
            <div className="x-w-full x-max-h-96 x-overflow-y-auto">
              {this.tips()}
              {this.items()}
            </div>
          </div>
        </Modal>
        <Backdrop
          sx={{color: '#fff', zIndex: (theme) => theme.zIndex.drawer + 1}}
          open={this.state.open}
          onClick={this.close}
        >
        </Backdrop>
      </div>
    );
  }
}