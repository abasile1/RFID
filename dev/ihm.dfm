object Form1: TForm1
  Left = 0
  Top = 0
  Caption = 'Form1'
  ClientHeight = 317
  ClientWidth = 456
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object Voyant: TShape
    Left = 328
    Top = 43
    Width = 65
    Height = 65
    Brush.Color = clMedGray
    Shape = stCircle
  end
  object MemoInfoTcp: TMemo
    Left = 80
    Top = 43
    Width = 209
    Height = 241
    TabOrder = 0
  end
  object IdTCPServer1: TIdTCPServer
    Active = True
    Bindings = <
      item
        IP = '0.0.0.0'
        Port = 1200
      end>
    DefaultPort = 1200
    OnConnect = IdTCPServer1Connect
    OnDisconnect = IdTCPServer1Disconnect
    OnExecute = IdTCPServer1Execute
    Left = 24
    Top = 24
  end
end
