<?php
  namespace task_game;
  enum EnumActionState {
    case NEUTRAL;
    case DEFENCE;
    case AVOID;
    case DEAD;
  }

  enum Enumskill {
    case NONE;
    case ATK_BUFF;
    case DEF_BUFF;
    case AGL_BUFF;
  }
?>