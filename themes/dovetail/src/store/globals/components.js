import { app } from '../app'
import { appbar } from '@/components/Appbar/store/modules/appbar'
import { auth } from '@/modules/Auth/store/modules/auth'
import { breadcrumbs } from '@/components/Breadcrumbs/store/modules/breadcrumbs'
import { repeater } from '@/components/Repeater/store/modules/repeater'
import { dataiterator } from '@/components/DataIterator/store/modules/dataiterator'
import { datatable } from '@/components/DataTable/store/modules/datatable'
import { dialog } from '@/components/Dialog/store/modules/dialog'
import { glance } from '@/components/Glance/store/modules/glance'
import { header } from '@/components/Header/store/modules/header'
import { sidebar } from '@/components/Sidebar/store/modules/sidebar'
import { snackbar } from '@/components/Snackbar/store/modules/snackbar'
import { submit } from '@/components/Submit/store/modules/submit'
import { theme } from './theme'
import { toolbar } from '@/components/Toolbar/store/modules/toolbar'

export const modules = {
  auth,
  app,
  appbar,
  breadcrumbs,
  repeater,
  dataiterator,
  datatable,
  dialog,
  glance,
  header,
  sidebar,
  snackbar,
  submit,
  theme,
  toolbar,
}
